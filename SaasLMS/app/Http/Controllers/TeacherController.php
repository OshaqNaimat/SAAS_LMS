<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\ClassRoom;
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
    $selectedDay = (int) $request->get('day', now()->dayOfWeekIso); // defaults to today (1-5, weekends clamp oddly but fine for a school app)
    if ($selectedDay < 1 || $selectedDay > 5) $selectedDay = 1;

    $periods = Schedule::with('classRoom')
        ->where('teacher_id', $teacher->id)
        ->where('day_of_week', $selectedDay)
        ->orderBy('period_number')
        ->get();

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
            $p->computedStatus = 'scheduled'; // not today, no live status
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
}
