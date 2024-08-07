<?php

namespace AvrilloCodeTest\ApiClient\Services;

use Illuminate\Support\Manager;
use AvrilloCodeTest\ApiClient\Interfaces\ApiClientDriver;

class ApiClientManager extends Manager
{
    /**
     * Define the GuzzleHttp driver.
     * 
     * @return ApiClientDriver
     */
    public function createGuzzleDriver(): ApiClientDriver
    {
        return new Guzzle();
    }

    /**
     * Define the default driver for the manager.
     * 
     * @return string
     */
    public function getDefaultDriver(): string
    {
        return $this->config->get('api-client.driver', 'guzzle');
    }
}