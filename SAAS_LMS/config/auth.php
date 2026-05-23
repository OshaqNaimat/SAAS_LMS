<?php

// ---------------------------------------------------------------------------
// Paste the 'guards' and 'providers' blocks below into your existing
// config/auth.php, merging them with what's already there.
// ---------------------------------------------------------------------------

return [

    'defaults' => [
        'guard'     => 'web',          // keep existing default
        'passwords' => 'users',
    ],

    'guards' => [
        // --- keep your existing 'web' guard ---
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],

        // --- ADD THIS ---
        'super_admin' => [
            'driver'   => 'session',
            'provider' => 'super_admins',
        ],
    ],

    'providers' => [
        // --- keep your existing 'users' provider ---
        'users' => [
            'driver' => 'eloquent',
            'model'  => App\Models\User::class,
        ],

        // --- ADD THIS ---
        'super_admins' => [
            'driver' => 'eloquent',
            'model'  => App\Models\SuperAdmin::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table'    => 'password_reset_tokens',
            'expire'   => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
