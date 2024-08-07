<?php

namespace AvrilloCodeTest\ApiClient\Facades;

use Illuminate\Support\Facades\Facade;
use AvrilloCodeTest\ApiClient\ApiClientManager;

class ApiClient extends Facade
{
    /**
     * Define the facade accessor.
     * 
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'apiClient';
    }
}