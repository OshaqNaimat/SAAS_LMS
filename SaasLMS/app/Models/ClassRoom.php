<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable = ['name', 'section', 'stream', 'room', 'max_seats', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
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
