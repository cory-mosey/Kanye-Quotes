<?php

namespace AvrilloCodeTest\AuthToken\Http\Controllers;

use AvrilloCodeTest\AuthToken\Token;
use Illuminate\Http\JsonResponse;

class GenerateToken
{
    /**
     * Generate the token and provide in response.
     * 
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $token = Token::create();

        return response()->json(['token' => $token], 200);
    }
}