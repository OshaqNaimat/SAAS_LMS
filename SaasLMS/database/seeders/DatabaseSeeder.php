<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $organization = Organization::firstOrCreate(
            ['slug' => 'first-school'],
            [
                'name' => 'First School',
                'contact_email' => 'admin1505@gmail.com',
                'plan' => 'trial',
                'status' => 'active',
                'subscription_starts_at' => now(),
                'max_users' => 100,
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin1505@gmail.com'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('#oshaqnaimat0515'),
                'role' => 'admin',
                'organization_id' => $organization->id,
            ]
        );
    }
}
