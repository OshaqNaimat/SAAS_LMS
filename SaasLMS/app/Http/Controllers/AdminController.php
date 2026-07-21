<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\GeneratedReport;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

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
    $totalRevenue = Payment::where('status', 'cleared')->sum('amount');

    $teacherTrend = [];
    $studentTrend = [];
    $trendLabels = [];

    for ($i = 6; $i >= 0; $i--) {
        $day = Carbon::today()->subDays($i);
        $trendLabels[] = $i === 0 ? 'Today' : $day->format('D');
        $teacherTrend[] = $this->dayAttendancePct('teacher', $day);
        $studentTrend[] = $this->dayAttendancePct('student', $day);
    }

    $recentMembers = User::latest()->take(4)->get();

    return view('admin.dashboard', compact(
        'totalTeachers', 'totalStudents', 'totalRevenue',
        'teacherTrend', 'studentTrend', 'trendLabels', 'recentMembers'
    ));
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
        'name'              => 'required|string|max:255',
        'section'           => 'required|string|max:255',
        'stream'            => 'nullable|string|max:255',
        'room'              => 'nullable|string|max:255',
        'max_seats'         => 'required|integer|min:1',
        'teacher_id'        => 'nullable|exists:users,id',
        'total_lessons'     => 'nullable|integer|min:0',
        'completed_lessons' => 'nullable|integer|min:0',
    ]);

    ClassRoom::create($request->only(
        'name', 'section', 'stream', 'room', 'max_seats', 'teacher_id',
        'total_lessons', 'completed_lessons'
    ));

    return back()->with('success', 'Class created successfully!');
}

public function updateClass(Request $request, ClassRoom $classRoom)
{
    $request->validate([
        'name'              => 'required|string|max:255',
        'section'           => 'required|string|max:255',
        'stream'            => 'nullable|string|max:255',
        'room'              => 'nullable|string|max:255',
        'max_seats'         => 'required|integer|min:1',
        'teacher_id'        => 'nullable|exists:users,id',
        'total_lessons'     => 'nullable|integer|min:0',
        'completed_lessons' => 'nullable|integer|min:0',
    ]);

    $classRoom->update($request->only(
        'name', 'section', 'stream', 'room', 'max_seats', 'teacher_id',
        'total_lessons', 'completed_lessons'
    ));

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
public function reportsIndex()
{
    $classes = ClassRoom::all();

    $totalSeats = $classes->sum('max_seats');
    $totalEnrolled = $classes->sum(fn ($c) => $c->studentCount());
    $rosterPct = $totalSeats > 0 ? round(($totalEnrolled / $totalSeats) * 100) : 0;

    $reports = GeneratedReport::latest()->get();

    return view('admin.reports', compact('classes', 'totalSeats', 'totalEnrolled', 'rosterPct', 'reports'));
}

public function generateReport(Request $request)
{
    $request->validate([
        'type' => 'required|in:attendance,roster,lessons',
        'class_id' => 'nullable|exists:class_rooms,id',
        'window' => 'required|in:current_term,previous_month,full_year',
    ]);

    [$from, $to] = $this->resolveWindow($request->window);

    $rows = match ($request->type) {
        'attendance' => $this->buildAttendanceCsv($from, $to, $request->class_id),
        'roster' => $this->buildRosterCsv(),
        'lessons' => $this->buildLessonsCsv(),
    };

    $label = match ($request->type) {
        'attendance' => 'Attendance_Compliance',
        'roster' => 'Roster_Capacity',
        'lessons' => 'Faculty_Lesson_Progress',
    };

    $filename = $label . '_' . now()->format('Ymd_His') . '.csv';
    $csvContent = $this->arrayToCsv($rows);

    Storage::disk('public')->put('reports/' . $filename, $csvContent);

    $report = GeneratedReport::create([
        'type' => $request->type,
        'filename' => $filename,
        'department' => match ($request->type) {
            'attendance' => 'Administration Control',
            'roster' => 'Academic Records',
            'lessons' => 'Curriculum Office',
        },
        'path' => 'reports/' . $filename,
        'size_bytes' => strlen($csvContent),
    ]);

    return back()->with('success', 'Report generated: ' . $filename);
}

public function downloadReport(GeneratedReport $report)
{
    return Storage::disk('public')->download($report->path, $report->filename);
}

private function resolveWindow($window)
{
    return match ($window) {
        'previous_month' => [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()],
        'full_year' => [now()->startOfYear(), now()->endOfYear()],
        default => [now()->startOfMonth(), now()], // current_term (simplified to current month)
    };
}

private function buildAttendanceCsv($from, $to, $classId)
{
    $query = Attendance::with('user')->whereBetween('date', [$from, $to]);
    $records = $query->get();

    $rows = [['Name', 'Role', 'Date', 'Status', 'Note']];
    foreach ($records as $r) {
        if (!$r->user) continue;
        $rows[] = [$r->user->name, $r->user->role, $r->date, $r->status, $r->note ?? ''];
    }
    return $rows;
}

private function buildRosterCsv()
{
    $classes = ClassRoom::with('teacher')->get();
    $rows = [['Class', 'Section', 'Teacher', 'Enrolled', 'Max Seats', 'Fill %']];
    foreach ($classes as $c) {
        $count = $c->studentCount();
        $pct = $c->max_seats > 0 ? round(($count / $c->max_seats) * 100) : 0;
        $rows[] = [$c->name, $c->section, $c->teacher->name ?? 'Unassigned', $count, $c->max_seats, $pct . '%'];
    }
    return $rows;
}

private function buildLessonsCsv()
{
    $classes = ClassRoom::with('teacher')->get();
    $rows = [['Class', 'Section', 'Teacher', 'Completed Lessons', 'Total Lessons', 'Progress %']];
    foreach ($classes as $c) {
        $pct = $c->total_lessons > 0 ? round(($c->completed_lessons / $c->total_lessons) * 100) : 0;
        $rows[] = [$c->name, $c->section, $c->teacher->name ?? 'Unassigned', $c->completed_lessons, $c->total_lessons, $pct . '%'];
    }
    return $rows;
}

private function arrayToCsv($rows)
{
    $handle = fopen('php://temp', 'r+');
    foreach ($rows as $row) {
        fputcsv($handle, $row);
    }
    rewind($handle);
    $csv = stream_get_contents($handle);
    fclose($handle);
    return $csv;
}
public function billingIndex(Request $request)
{
    $query = Payment::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('student_name', 'like', "%{$search}%")
              ->orWhere('roll_number', 'like', "%{$search}%")
              ->orWhere('voucher_id', 'like', "%{$search}%");
        });
    }

    $payments = $query->latest()->get();

    $totalCollected = Payment::where('status', 'cleared')->sum('amount');
    $outstanding = Payment::where('status', 'pending')->sum('amount');
    $pendingCount = Payment::where('status', 'pending')->count();
    $overdueCount = Payment::where('status', 'overdue')->count();

    $totalInvoiced = Payment::sum('amount');
    $collectedPct = $totalInvoiced > 0 ? round(($totalCollected / $totalInvoiced) * 100) : 0;

    $bankAmount = Payment::where('channel', 'like', '%Bank%')->orWhere('channel', 'like', '%Pay Order%')->sum('amount');
    $cashAmount = Payment::where('channel', 'like', '%Cash%')->sum('amount');
    $totalChannelAmount = $bankAmount + $cashAmount;
    $bankPct = $totalChannelAmount > 0 ? round(($bankAmount / $totalChannelAmount) * 100) : 0;
    $cashPct = 100 - $bankPct;

    // Category breakdown for the bar chart
    $categories = ['Tuition Fee', 'Exam Fee', 'Admission Fee', 'Sports / Lab'];
    $categoryTotals = [];
    $maxCategoryAmount = Payment::selectRaw('category, SUM(amount) as total')
        ->groupBy('category')->pluck('total', 'category');
    $peak = $maxCategoryAmount->max() ?: 1;
    foreach ($categories as $cat) {
        $amount = $maxCategoryAmount[$cat] ?? 0;
        $categoryTotals[$cat] = round(($amount / $peak) * 100);
    }

    // Channel breakdown for the progress bars
    $channels = ['Bank Deposit (HBL)', 'Cash Counter', 'Pay Order'];
    $channelTotals = [];
    $channelSums = Payment::selectRaw('channel, SUM(amount) as total')->groupBy('channel')->pluck('total', 'channel');
    $totalAllChannels = $channelSums->sum() ?: 1;
    foreach ($channels as $ch) {
        $amount = $channelSums[$ch] ?? 0;
        $channelTotals[$ch] = round(($amount / $totalAllChannels) * 100);
    }

    $payments = Payment::latest()->get(); // full list on initial page load

    return view('admin.billings', compact(
        'payments', 'totalCollected', 'outstanding', 'pendingCount', 'overdueCount',
        'collectedPct', 'bankPct', 'cashPct', 'categoryTotals', 'channelTotals'
    ));
}

public function storePayment(Request $request)
{
    $request->validate([
        'roll_number'  => 'required|string',
        'student_name' => 'required|string|max:255',
        'category'     => 'required|string',
        'channel'      => 'required|string',
        'amount'       => 'required|integer|min:1',
        'status'       => 'required|in:cleared,pending,overdue',
    ]);

    $student = \App\Models\User::where('roll_number', $request->roll_number)->where('role', 'student')->first();

    $voucherId = '#VCH-' . now()->format('Y') . '-' . str_pad(Payment::count() + 9041, 4, '0', STR_PAD_LEFT);

    Payment::create([
        'voucher_id'   => $voucherId,
        'student_id'   => $student->id ?? null,
        'student_name' => $request->student_name,
        'roll_number'  => $request->roll_number,
        'category'     => $request->category,
        'channel'      => $request->channel,
        'amount'       => $request->amount,
        'status'       => $request->status,
        'recorded_by'  => Auth::id(),
    ]);

    return back()->with('success', 'Payment recorded successfully!');
}
public function searchPayments(Request $request)
{
    $search = $request->get('search', '');

    $payments = Payment::when($search, function ($q) use ($search) {
        $q->where('student_name', 'like', "%{$search}%")
          ->orWhere('roll_number', 'like', "%{$search}%")
          ->orWhere('voucher_id', 'like', "%{$search}%");
    })->latest()->get();

    return response()->json([
        'html' => view('admin.billing-rows', compact('payments'))->render(),
    ]);
}
public function updatePayment(Request $request, Payment $payment)
{
    $request->validate([
        'status' => 'required|in:cleared,pending,overdue',
    ]);

    $payment->update(['status' => $request->status]);

    return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
}



private function dayAttendancePct($role, $day)
{
    $userIds = User::where('role', $role)->pluck('id');
    $total = Attendance::whereIn('user_id', $userIds)->where('date', $day)->count();
    if ($total === 0) return 0;
    $present = Attendance::whereIn('user_id', $userIds)->where('date', $day)->where('status', 'present')->count();
    return round(($present / $total) * 100);
}
};
