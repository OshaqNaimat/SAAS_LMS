<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
   protected $fillable = [
    'name', 'section', 'stream', 'room', 'max_seats', 'teacher_id',
    'total_lessons', 'completed_lessons', 'organization_id',
];

    // Original: single "lead mentor" relationship (used by Classes page, admin.classesIndex)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // New: many-to-many, multiple subject teachers per class
    public function subjectTeachers()
    {
        return $this->belongsToMany(User::class, 'class_teacher', 'class_room_id', 'teacher_id')->withPivot('subject');
    }

    public function studentCount()
{
    return User::where('role', 'student')
        ->where('class_room_id', $this->id)
        ->count();
}
}
