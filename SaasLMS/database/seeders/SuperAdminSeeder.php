<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@nexus.io'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Iamtheonlysuperadmin1505'),
                'role' => 'super_admin',
            ]
        );
    }
}
