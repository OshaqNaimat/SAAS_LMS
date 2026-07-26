<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Payment;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Auth::user();

        // Attendance stats (last 30 days rolling, matching your existing attendanceRate() helper)
        $attendanceRate = $student->attendanceRate() ?? 0;

        $last30 = Attendance::where('user_id', $student->id)
            ->where('date', '>=', now()->subDays(30))
            ->get();

        $presentCount = $last30->where('status', 'present')->count();
        $absentCount = $last30->where('status', 'absent')->count();
        $leaveCount = $last30->where('status', 'approved_leave')->count();

        // Full weekly timetable, from the real Schedule table, matched to student's class
     $periods = collect();

if ($student->class_room_id) {
    $periods = Schedule::with('teacher')
        ->where('class_room_id', $student->class_room_id)
        ->orderBy('period_number')
        ->get()
        ->groupBy('day_of_week');
}
        // Fees — match payments by roll_number
        $payments = Payment::where('roll_number', $student->roll_number)->orderBy('created_at')->get();
        $totalPaid = $payments->where('status', 'cleared')->sum('amount');
        $totalDue = $payments->whereIn('status', ['pending', 'overdue'])->sum('amount');
        $feeHistory = $payments->map(fn ($p) => [
            'label' => $p->created_at->format('M'),
            'amount' => $p->amount,
            'status' => $p->status,
        ]);

    return view('student.dashboard', compact(
            'student', 'attendanceRate', 'presentCount', 'absentCount', 'leaveCount',
            'periods', 'totalPaid', 'totalDue', 'feeHistory'
        ));
    }
    public function attendanceAnalytics()
{
    $student = Auth::user();

    // Real subjects/instructors, from the same Schedule table admin uses to assign teachers
    $subjects = collect();
    if ($student->class_room_id) {
        $subjects = Schedule::with('teacher')
            ->where('class_room_id', $student->class_room_id)
            ->get()
            ->unique('subject')
            ->values();
    }

    // Real overall attendance stats (last 30 days, matching your existing pattern)
    $records = Attendance::where('user_id', $student->id)
        ->where('date', '>=', now()->subDays(30))
        ->get();

    $totalDelivered = $records->count();
    $totalPresent = $records->where('status', 'present')->count();
    $totalAbsent = $records->where('status', 'absent')->count();
    $avgAttendance = $totalDelivered > 0 ? round(($totalPresent / $totalDelivered) * 100, 1) : 0;

    // Recent log entries (last 4 real attendance records)
    $recentLogs = Attendance::where('user_id', $student->id)
        ->orderByDesc('date')
        ->take(4)
        ->get();

    return view('student.student-attendence', compact(
        'subjects', 'totalDelivered', 'totalPresent', 'totalAbsent', 'avgAttendance', 'recentLogs'
    ));
}
}
