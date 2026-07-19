<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function storeTeacher(Request $request)
{
    $request->validate([
        'name'           => 'required|string|max:255',
        'email'          => 'required|email|unique:users,email',
        'password'       => 'required|string|min:6',
        'assigned_class' => 'nullable|string',
    ]);

    User::create([
        'name'           => $request->name,
        'email'          => $request->email,
        'password'       => Hash::make($request->password),
        'role'           => 'teacher', // hardcode server-side, don't trust the hidden input
        'assigned_class' => $request->assigned_class,
    ]);

    return back()->with('success', 'Teacher Registered successfully!');
}

public function storeStudent(Request $request)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'father_name' => 'required|string|max:255',
        'roll_number' => 'required|string|unique:users,roll_number',
        'class'       => 'required|string',
        'section'     => 'required|string',
        'password'    => 'required|string|min:4',
    ]);

    User::create([
        'name'        => $request->name,
        'father_name' => $request->father_name,
        'roll_number' => $request->roll_number,
        'class'       => $request->class,
        'section'     => $request->section,
        'password'    => Hash::make($request->password),
        'role'        => 'student', // hardcode server-side
    ]);

    return back()->with('success', 'New Student Registered successfully!');
}
public function facultyRoster()
{
    $teachers = User::where('role', 'teacher')->latest()->get();
    $students = User::where('role', 'student')->latest()->get();

    return view('admin.faculty', compact('teachers', 'students')); // ✅ correct
}
public function dashboard()
{
    $totalTeachers = User::where('role', 'teacher')->count();
    $totalStudents = User::where('role', 'student')->count();

    return view('admin.dashboard', compact('totalTeachers', 'totalStudents'));
}
public function destroy(User $user)
{
    $user->delete();
    return back()->with('success', ucfirst($user->role) . ' removed successfully!');
}

public function updateTeacher(Request $request, User $user)
{
    $request->validate([
        'name'           => 'required|string|max:255',
        'email'          => 'required|email|unique:users,email,' . $user->id,
        'assigned_class' => 'nullable|string',
    ]);

    $user->update([
        'name'           => $request->name,
        'email'          => $request->email,
        'assigned_class' => $request->assigned_class,
    ]);

    return back()->with('success', 'Teacher updated successfully!');
}

public function updateStudent(Request $request, User $user)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'father_name' => 'required|string|max:255',
        'roll_number' => 'required|string|unique:users,roll_number,' . $user->id,
        'class'       => 'required|string',
        'section'     => 'required|string',
    ]);

    $user->update($request->only('name', 'father_name', 'roll_number', 'class', 'section'));

    return back()->with('success', 'Student updated successfully!');
}
public function classesIndex()
{
    $classes = ClassRoom::with('teacher')->latest()->get();
    $teachers = User::where('role', 'teacher')->get();

    $totalClasses = $classes->count();
    $overcrowded = $classes->filter(fn ($c) => $c->studentCount() >= $c->max_seats)->count();

    return view('admin.classes', compact('classes', 'teachers', 'totalClasses', 'overcrowded'));
}

public function storeClass(Request $request)
{
    $request->validate([
        'name'       => 'required|string|max:255',
        'section'    => 'required|string|max:255',
        'stream'     => 'nullable|string|max:255',
        'room'       => 'nullable|string|max:255',
        'max_seats'  => 'required|integer|min:1',
        'teacher_id' => 'nullable|exists:users,id',
    ]);

    ClassRoom::create($request->only('name', 'section', 'stream', 'room', 'max_seats', 'teacher_id'));

    return back()->with('success', 'Class created successfully!');
}

public function updateClass(Request $request, ClassRoom $classRoom)
{
    $request->validate([
        'name'       => 'required|string|max:255',
        'section'    => 'required|string|max:255',
        'stream'     => 'nullable|string|max:255',
        'room'       => 'nullable|string|max:255',
        'max_seats'  => 'required|integer|min:1',
        'teacher_id' => 'nullable|exists:users,id',
    ]);

    $classRoom->update($request->only('name', 'section', 'stream', 'room', 'max_seats', 'teacher_id'));

    return back()->with('success', 'Class updated successfully!');
}

public function destroyClass(ClassRoom $classRoom)
{
    $classRoom->delete();
    return back()->with('success', 'Class removed successfully!');
}

private function buildHistory($limit = 10)
{
    return [
        'students' => $this->buildHistoryForRole('student', $limit),
        'teachers' => $this->buildHistoryForRole('teacher', $limit),
    ];
}

private function buildHistoryForRole($role, $limit = 10)
{
    $userIds = User::where('role', $role)->pluck('id');

    $dates = Attendance::whereIn('user_id', $userIds)
        ->select('date')->distinct()->orderByDesc('date')->limit($limit)->pluck('date');

    return $dates->map(function ($date) use ($userIds) {
        $records = Attendance::where('date', $date)->whereIn('user_id', $userIds)->with('user')->get();
        $total = $records->count();
        $present = $records->where('status', 'present')->count();
        $pct = $total > 0 ? round(($present / $total) * 100) : 0;

        return [
            'date' => Carbon::parse($date)->format('M d, Y'),
            'pct' => $pct,
            'entries' => $records->map(fn ($r) => [
                'name' => $r->user->name ?? 'Unknown',
                'present' => $r->status === 'present',
            ])->values(),
        ];
    })->values();
}

public function saveBatchAttendance(Request $request)
{
    $request->validate([
        'changes' => 'required|array',
        'changes.*.user_id' => 'required|exists:users,id',
        'changes.*.status' => 'required|in:present,absent,late,approved_leave',
        'changes.*.note' => 'nullable|string',
    ]);

    $today = Carbon::today();

    foreach ($request->changes as $change) {
        Attendance::updateOrCreate(
            ['user_id' => $change['user_id'], 'date' => $today],
            ['status' => $change['status'], 'note' => $change['note'] ?? null, 'marked_by' => Auth::id()]
        );
    }

    return response()->json(['success' => true, 'message' => 'Attendance saved successfully!']);
}


public function attendanceIndex()
{
    $today = Carbon::today();

    $students = User::where('role', 'student')->get();
    $teachers = User::where('role', 'teacher')->get();

    // Today's attendance keyed by user_id for quick lookup
    $todayRecords = Attendance::where('date', $today)->get()->keyBy('user_id');

    // Overall rates
    $studentRate = $this->overallRate('student', $today);
    $facultyRate = $this->overallRate('teacher', $today);

    $studentAbsentToday = Attendance::where('date', $today)->where('status', 'absent')
        ->whereIn('user_id', $students->pluck('id'))->count();

    $facultyOnLeave = Attendance::where('date', $today)->where('status', 'approved_leave')
        ->whereIn('user_id', $teachers->pluck('id'))->count();

    // Last 5 days trend for the velocity chart
    $trend = [];
    for ($i = 4; $i >= 0; $i--) {
        $day = $today->copy()->subDays($i);
        $trend[] = [
            'label' => $day->format('D'),
            'student_pct' => $this->dayRate('student', $day),
            'faculty_pct' => $this->dayRate('teacher', $day),
        ];
    }

    // Incident breakdown today (students only)
    $incidentTotal = Attendance::where('date', $today)
        ->whereIn('user_id', $students->pluck('id'))
        ->whereIn('status', ['absent', 'late', 'approved_leave'])->count();

    $incidents = [
        'leave'   => Attendance::where('date', $today)->where('status', 'approved_leave')->whereIn('user_id', $students->pluck('id'))->count(),
        'absent'  => Attendance::where('date', $today)->where('status', 'absent')->whereIn('user_id', $students->pluck('id'))->count(),
        'late'    => Attendance::where('date', $today)->where('status', 'late')->whereIn('user_id', $students->pluck('id'))->count(),
    ];

    $history = $this->buildHistory();

    return view('admin.attendence', compact(
        'students', 'teachers', 'todayRecords', 'studentRate', 'facultyRate',
        'studentAbsentToday', 'facultyOnLeave', 'trend', 'incidents', 'incidentTotal', 'history'
    ));
}

private function overallRate($role, $today)
{
    $userIds = User::where('role', $role)->pluck('id');
    $total = Attendance::whereIn('user_id', $userIds)->where('date', $today)->count();
    if ($total === 0) return 0;
    $present = Attendance::whereIn('user_id', $userIds)->where('date', $today)->where('status', 'present')->count();
    return round(($present / $total) * 100, 1);
}

private function dayRate($role, $day)
{
    $userIds = User::where('role', $role)->pluck('id');
    $total = Attendance::whereIn('user_id', $userIds)->where('date', $day)->count();
    if ($total === 0) return 0;
    $present = Attendance::whereIn('user_id', $userIds)->where('date', $day)->where('status', 'present')->count();
    return round(($present / $total) * 100);
}

public function markAttendance(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'status'  => 'required|in:present,absent,late,approved_leave',
        'note'    => 'nullable|string',
    ]);

    Attendance::updateOrCreate(
        ['user_id' => $request->user_id, 'date' => Carbon::today()],
        ['status' => $request->status, 'note' => $request->note, 'marked_by' => Auth::id()]
    );

    return response()->json(['success' => true, 'message' => 'Attendance updated!']);
}

public function bulkMarkPresent(Request $request)
{
    $request->validate(['role' => 'required|in:student,teacher']);
    $today = Carbon::today();

    $users = User::where('role', $request->role)->get();
    foreach ($users as $user) {
        Attendance::updateOrCreate(
            ['user_id' => $user->id, 'date' => $today],
            ['status' => 'present', 'marked_by' => Auth::id()]
        );
    }

    return response()->json(['success' => true, 'message' => ucfirst($request->role) . 's marked present!']);
}
};
