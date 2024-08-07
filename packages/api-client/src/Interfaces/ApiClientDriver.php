<?php

namespace AvrilloCodeTest\ApiClient\Interfaces;

use AvrilloCodeTest\ApiClient\Services\ApiResponse;

interface ApiClientDriver {

    /**
     * Define the interface function used for GET request methods.
     * 
     * @param string $url
     * @return ApiResponse
     * @throws ApiException
     */
    public function get(string $url): ApiResponse;

    /**
     * Define the interface function for batching GET request methods.
     * 
     * @param string $url
     * @return ApiResponse
     * @throws ApiException
     */
    public function batchGet(array $endpoints = []): array;

}