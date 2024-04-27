<?php
return [
    'secret' => env('JWT_SECRET', '7Uv9SqVx16j0i9m3Ib29YzCPCralipyZ'),
    'ttl' => 60,
    'refresh_ttl' => 20160,
    'algo' => 'HS256',
    'user' => 'App\Models\User',
    'identifier' => 'id',
    'required_claims' => ['iss', 'iat', 'exp', 'nbf', 'sub', 'jti'],
    'ttl' => env('JWT_TTL',60), 
    'blacklist_enabled' => env('JWT_BLACKLIST_ENABLED', true),
    'providers' => [
        'user' => 'Tymon\JWTAuth\Providers\User\EloquentUserAdapter',
        'jwt' => 'Tymon\JWTAuth\Providers\JWT\NamshiAdapter',
        'auth' => 'Tymon\JWTAuth\Providers\Auth\IlluminateAuthAdapter',
        'storage' => 'Tymon\JWTAuth\Providers\Storage\IlluminateCacheAdapter',
    ],
];
