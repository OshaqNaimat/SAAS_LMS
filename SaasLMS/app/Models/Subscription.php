<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'organization_id', 'plan', 'amount', 'billing_cycle',
        'period_starts_at', 'period_ends_at', 'recorded_by', 'notes',
    ];

    protected $casts = [
        'period_starts_at' => 'date',
        'period_ends_at' => 'date',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
