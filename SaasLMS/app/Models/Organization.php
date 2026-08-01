<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name', 'slug', 'contact_email', 'contact_phone',
        'plan', 'status', 'subscription_starts_at', 'subscription_ends_at', 'max_users',
    ];

    protected $casts = [
        'subscription_starts_at' => 'date',
        'subscription_ends_at' => 'date',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function admins()
    {
        return $this->hasMany(User::class)->where('role', 'admin');
    }

    public function isSubscriptionActive()
    {
        return $this->status === 'active' &&
            (!$this->subscription_ends_at || $this->subscription_ends_at->isFuture());
    }
}
