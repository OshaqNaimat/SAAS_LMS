<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'voucher_id', 'student_id', 'student_name', 'roll_number',
        'category', 'channel', 'amount', 'status', 'recorded_by',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
