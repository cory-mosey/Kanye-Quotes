<?php

namespace Tests\Feature;

use Tests\TestCase;
use AvrilloCodeTest\AuthToken\Token;

class QuotesTest extends TestCase
{
    public function test_unauthenticated_quotes_endpoint_response(): void
    {
        $response = $this->get('/v1/quotes');

        $response->assertStatus(401);
    }

    public function test_authenticated_quotes_endpoint_response(): void
    {
        $token = Token::create();
        
        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}"
        ])->get('/v1/quotes');

        $response->assertStatus(200);
    }

    public function test_authenticated_quotes_endpoint_response_array_total(): void
    {
        $token = Token::create();

        $standardResponse = $this->withHeaders([
            'Authorization' => "Bearer {$token}"
        ])->get('/v1/quotes');

        $this->assertCount(5, $standardResponse['quotes']);

        $limitResponse = $this->withHeaders([
            'Authorization' => "Bearer {$token}"
        ])->get('/v1/quotes?limit=8');

        $this->assertCount(8, $limitResponse['quotes']);
    }
}
