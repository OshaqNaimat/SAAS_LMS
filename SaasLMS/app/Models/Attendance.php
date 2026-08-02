<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['user_id', 'date', 'status', 'note', 'marked_by', 'organization_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
