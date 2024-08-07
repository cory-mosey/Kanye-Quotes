<?php

namespace AvrilloCodeTest\AuthToken\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AuthTokenServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     * 
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/auth-token.php', 'auth-token');
    }

    /**
     * Boot the service provider.
     * 
     * @return void
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
    }
}