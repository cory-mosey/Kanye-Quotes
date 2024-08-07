<?php

namespace AvrilloCodeTest\ApiClient\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use AvrilloCodeTest\ApiClient\Services\ApiClientManager;

class ApiClientServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     * 
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/api-client.php', 'api-client');

        $this->app->singleton('apiClient', function ($app) {
            return new ApiClientManager($app);
        });
    }
}