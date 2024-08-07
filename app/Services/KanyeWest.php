<?php

namespace App\Services;

use AvrilloCodeTest\ApiClient\Facades\ApiClient;

final class KanyeWest
{   
    /**
     * Return quotes for Kanye West via the supplied API.
     * 
     * @param int $limit
     * @return array
     */
    public static function quotes(int $limit = 5): array
    {
        $quotes = ApiClient::batchGet(
            array_fill(0, $limit, "https://api.kanye.rest")
        );

        return array_map(fn($item) => $item->getBody()->quote, $quotes);
    }
}