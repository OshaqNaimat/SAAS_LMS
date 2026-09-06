<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
  protected $fillable = [
    'name', 'email', 'password', 'role', 'father_name', 'roll_number',
    'class', 'section', 'assigned_class', 'class_room_id', 'organization_id', 'joining_date'
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
   public function attendanceRate($days = 30)
{
     $today = Carbon::today();

    $students = User::where('role', 'student')->get();
    $teachers = User::where('role', 'teacher')->get();

    // Ensure every student/teacher has a row for today, defaulting to present,
    // so history/percentages reflect the full roster, not just explicitly-marked users.
    $allUserIds = $students->pluck('id')->merge($teachers->pluck('id'));
    $alreadyMarkedIds = Attendance::where('date', $today)->whereIn('user_id', $allUserIds)->pluck('user_id');
    $unmarkedIds = $allUserIds->diff($alreadyMarkedIds);

    foreach ($unmarkedIds as $userId) {
        Attendance::create([
            'user_id' => $userId,
            'date' => $today,
            'status' => 'present',
        ]);
    }

    // Today's attendance keyed by user_id for quick lookup
    $todayRecords = Attendance::where('date', $today)->get()->keyBy('user_id');
    $total = \App\Models\Attendance::where('user_id', $this->id)
        ->where('date', '>=', now()->subDays($days))
        ->count();

    if ($total === 0) return null;

    $present = \App\Models\Attendance::where('user_id', $this->id)
        ->where('date', '>=', now()->subDays($days))
        ->where('status', 'present')
        ->count();

    return round(($present / $total) * 100, 1);
}
public function classes()
{
    return $this->belongsToMany(ClassRoom::class, 'class_teacher', 'teacher_id', 'class_room_id')->withPivot('subject');
}
// In User model, add:
public function classRoom()
{
    return $this->belongsTo(ClassRoom::class, 'class_room_id');
}
public function organization()
{
    return $this->belongsTo(Organization::class);
}


public function ledClasses()
{
    return $this->hasMany(ClassRoom::class, 'teacher_id');
}
}
