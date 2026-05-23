<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        SuperAdmin::updateOrCreate(
            ['email' => 'superadmin@educore.app'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('#SAASLMSPROGRAM0515'),   // Change before going live!
            ]
        );
    }
}
