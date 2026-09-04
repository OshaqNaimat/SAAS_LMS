<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\Substitution;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;


class TeacherController extends Controller
{
   public function dashboard()
{
    $teacher = Auth::user();

    // Use teacher_id (lead mentor) instead of the pivot table, since that's what admin actually assigns
    $classes = ClassRoom::where('teacher_id', $teacher->id)->get();

    $students = User::where('role', 'student')
        ->whereIn('class', $classes->pluck('name'))
        ->whereIn('section', $classes->pluck('section'))
        ->get();

    $today = Carbon::today();
    $todayRecords = Attendance::where('date', $today)
        ->whereIn('user_id', $students->pluck('id'))
        ->get()->keyBy('user_id');

    $avgAttendance = $students->count() > 0
        ? round($students->map(fn ($s) => $s->attendanceRate() ?? 0)->avg(), 1)
        : 0;

    return view('teacher.dashboard', compact('classes', 'students', 'todayRecords', 'avgAttendance'));
}
public function timetable(Request $request)
{
    $teacher = Auth::user();
    $selectedDay = (int) $request->get('day', now()->dayOfWeekIso);
    if ($selectedDay < 1 || $selectedDay > 6) $selectedDay = 1;

    // Pin the selected weekday to an actual calendar date within the current week,
    // since substitutions are tied to a specific date, not a recurring weekday.
    $targetDate = now()->startOfWeek(Carbon::MONDAY)->addDays($selectedDay - 1)->toDateString();

    // This teacher's own regular periods for that day
    $periods = Schedule::with('classRoom')
        ->where('teacher_id', $teacher->id)
        ->where('day_of_week', $selectedDay)
        ->orderBy('period_number')
        ->get();

    // Any of those periods that got covered by someone else on that date
    $coveredSubs = Substitution::whereIn('schedule_id', $periods->pluck('id'))
        ->where('date', $targetDate)
        ->with('substituteTeacher')
        ->get()
        ->keyBy('schedule_id');

    foreach ($periods as $p) {
        $p->coveredBy = $coveredSubs->get($p->id); // null if not substituted
        $p->substitutingFor = null;
    }

    // Periods THIS teacher is covering for someone else on that date
    $coveringSubs = Substitution::where('substitute_teacher_id', $teacher->id)
        ->where('date', $targetDate)
        ->whereHas('schedule', fn ($q) => $q->where('day_of_week', $selectedDay))
        ->with(['schedule.classRoom', 'schedule.teacher'])
        ->get();

    foreach ($coveringSubs as $sub) {
        $p = $sub->schedule;
        $p->coveredBy = null;
        $p->substitutingFor = $p->teacher->name ?? 'another teacher';
        $periods->push($p);
    }

    $periods = $periods->sortBy('period_number')->values();

    $totalToday = $periods->count();
    $workloadMinutes = $periods->sum(function ($p) {
        return \Carbon\Carbon::parse($p->end_time)->diffInMinutes(\Carbon\Carbon::parse($p->start_time));
    });
    $workloadHours = round($workloadMinutes / 60, 1);

    $now = now();
    foreach ($periods as $p) {
        $start = \Carbon\Carbon::parse($p->start_time);
        $end = \Carbon\Carbon::parse($p->end_time);
        $nowTime = \Carbon\Carbon::createFromTimeString($now->format('H:i:s'));

        if ($selectedDay != now()->dayOfWeekIso) {
            $p->computedStatus = 'scheduled';
        } elseif ($p->coveredBy) {
            $p->computedStatus = 'covered'; // don't show as ongoing/upcoming if someone else is teaching it
        } elseif ($nowTime->between($start, $end)) {
            $p->computedStatus = 'ongoing';
        } elseif ($nowTime->lt($start)) {
            $p->computedStatus = 'upcoming';
        } else {
            $p->computedStatus = 'done';
        }
    }

    return view('teacher.Schedule', compact('periods', 'selectedDay', 'totalToday', 'workloadHours'));
}


public function saveAttendance(Request $request)
{
    $request->validate([
        'class_id' => 'required|exists:class_rooms,id',
        'attendance' => 'required|array',
        'attendance.*' => 'required|in:present,absent,approved_leave',
    ]);

    $today = Carbon::today();

    foreach ($request->attendance as $studentId => $status) {
        Attendance::updateOrCreate(
            ['user_id' => $studentId, 'date' => $today],
            ['status' => $status, 'marked_by' => Auth::id()]
        );
    }

    return back()->with('success', 'Attendance saved successfully!')->with('class_id', $request->class_id);
}
private function getTeacherClasses($teacherId)
    {
        // Get classes where teacher is primary teacher OR assigned in timetable schedule
        $scheduledClassIds = Schedule::where('teacher_id', $teacherId)
            ->pluck('class_room_id')
            ->filter();

        return ClassRoom::where('teacher_id', $teacherId)
            ->orWhereIn('id', $scheduledClassIds)
            ->get();
    }

    public function classesIndex()
    {
        $teacher = Auth::user();
        $classes = $this->getTeacherClasses($teacher->id);

        $totalEnrolled = $classes->sum(fn ($c) => method_exists($c, 'studentCount') ? $c->studentCount() : User::where('role', 'student')->where('class_room_id', $c->id)->count());

        return view('teacher.assigned-batches', compact('classes', 'totalEnrolled'));
    }

    public function attendanceIndex(Request $request)
    {
        $teacher = Auth::user();

        // 1. Fetch assigned classes
        $classes = $this->getTeacherClasses($teacher->id);

        // 2. Select default or requested class
        $selectedClassId = $request->get('class_id', $classes->first()->id ?? null);
        $selectedClass = $classes->firstWhere('id', $selectedClassId);

        $students = collect();
        $todayRecords = collect();

        if ($selectedClass) {
            // 3. Fetch students belonging to the selected class with relationships
            $students = User::where('role', 'student')
                ->where('class_room_id', $selectedClass->id)
                ->with('classRoom')
                ->orderBy('roll_number', 'asc')
                ->orderBy('name', 'asc')
                ->get();

            // 4. Fetch today's attendance records keyed by user_id
            if ($students->isNotEmpty()) {
                $todayRecords = Attendance::whereDate('date', Carbon::today())
                    ->whereIn('user_id', $students->pluck('id'))
                    ->get()
                    ->keyBy('user_id');
            }
        }

        $presentCount = $todayRecords->where('status', 'present')->count();
        $absentCount = $todayRecords->where('status', 'absent')->count();
        $leaveCount = $todayRecords->whereIn('status', ['approved_leave', 'leave'])->count();

        return view('teacher.attendence-registry', compact(
            'classes', 'selectedClass', 'selectedClassId', 'students', 'todayRecords',
            'presentCount', 'absentCount', 'leaveCount'
        ));
    }
}
