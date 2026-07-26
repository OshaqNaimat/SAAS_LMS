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

        // Today's periods, from the real Schedule table, matched to student's class
        $today = now()->dayOfWeekIso;
        $periods = collect();
        if ($student->class_room_id && $today >= 1 && $today <= 5) {
            $periods = Schedule::with('teacher')
                ->where('class_room_id', $student->class_room_id)
                ->where('day_of_week', $today)
                ->orderBy('period_number')
                ->get();

            $nowTime = Carbon::createFromTimeString(now()->format('H:i:s'));
            foreach ($periods as $p) {
                $start = Carbon::parse($p->start_time);
                $end = Carbon::parse($p->end_time);
                if ($nowTime->between($start, $end)) {
                    $p->computedStatus = 'ongoing';
                } elseif ($nowTime->lt($start)) {
                    $p->computedStatus = 'upcoming';
                } else {
                    $p->computedStatus = 'ended';
                }
            }
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
}
