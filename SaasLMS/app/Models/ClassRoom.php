<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable = ['name', 'section', 'stream', 'room', 'max_seats', 'teacher_id'];

    public function teachers()
{
    return $this->belongsToMany(User::class, 'class_teacher', 'class_room_id', 'teacher_id')->withPivot('subject');
}

    // Students are matched by matching class+section text fields on users
    public function studentCount()
    {
        return User::where('role', 'student')
            ->where('class', $this->name)
            ->where('section', $this->section)
            ->count();
    }
}
