<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Substitution extends Model
{
    protected $fillable = ['schedule_id', 'date', 'substitute_teacher_id', 'reason', 'organization_id'];

    protected $casts = ['date' => 'date'];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function substituteTeacher()
    {
        return $this->belongsTo(User::class, 'substitute_teacher_id');
    }
}
