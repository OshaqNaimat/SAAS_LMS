<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the admin account already exists to prevent duplicate entries
        User::updateOrCreate(
            ['email' => 'admin0515@gmail.com'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('initialpassword0515'),
                'role' => 'admin', // Enforcing structural role identification matching multi-role guards
            ]
        );
    }
}
