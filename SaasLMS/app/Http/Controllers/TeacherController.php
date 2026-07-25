<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
}
