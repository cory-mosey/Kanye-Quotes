<?php

namespace AvrilloCodeTest\AuthToken;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class Token
{
    /**
     * Create the token to be used for authentication on the API.
     * 
     * @return string
     */
    public static function create(): string
    {
        Cache::put(
            config('auth-token.name', 'auth-token'),
            hash('sha256', Str::random(40)),
            config('auth-token.expiry', 600)
        );

        return self::get();
    }

    /**
     * Get the token from the cache.
     * 
     * @return string
     */
    public static function get(): ?string
    {
        return Cache::get(
            config('auth-token.name', 'auth-token'),
            null
        );
    }

    /**
     * Check if the token matches the cached token.
     * 
     * @param string $bearer
     * @return bool
     */
    public static function check(string $bearer): bool
    {
        return $bearer === self::get();
    }
}