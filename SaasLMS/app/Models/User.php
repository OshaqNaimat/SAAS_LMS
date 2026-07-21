<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    'name',
    'father_name',
    'email',
    'roll_number',
    'password',
    'role',
    'class',
    'section',
    'assigned_class'
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
}
