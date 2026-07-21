<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $teacher = Auth::user();
        $classes = $teacher->classes; // all ClassRoom models this teacher is linked to

        // Students across all of the teacher's classes
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
}
