<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tenant extends Model
{
    protected $fillable = [
        'company_name',
        'slug',
        'admin_name',
        'admin_email',
        'password',
        'status',
        'student_count',
    ];

    protected $hidden = ['password'];

    // ---------------------------------------------------------------------------
    // Auto-generate a unique slug from company_name before saving
    // ---------------------------------------------------------------------------
    protected static function booted(): void
    {
        static::creating(function (Tenant $tenant) {
            $base = Str::slug($tenant->company_name);
            $slug = $base;
            $i    = 2;

            while (static::where('slug', $slug)->exists()) {
                $slug = "{$base}-{$i}";
                $i++;
            }

            $tenant->slug = $slug;
        });
    }

    // ---------------------------------------------------------------------------
    // Helpers
    // ---------------------------------------------------------------------------
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'active'    => 'bg-emerald-100 text-emerald-800',
            'idle'      => 'bg-slate-100 text-slate-600',
            'suspended' => 'bg-red-100 text-red-700',
            default     => 'bg-slate-100 text-slate-600',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return ucfirst($this->status);
    }
}
