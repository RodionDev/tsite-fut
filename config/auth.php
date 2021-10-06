<?php
return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'user',
    ],
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'user',
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'user',
        ],
    ],
    'providers' => [
        'user' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],
    'passwords' => [
        'user' => [
            'provider' => 'user',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],
];
