<?php

namespace Tests\Feature;

use Tests\TestCase;
use AvrilloCodeTest\AuthToken\Token;

class QuotesTest extends TestCase
{
    public function test_unauthenticated_quotes_endpoint_response(): void
    {
        $response = $this->get('/api/quotes');

        $response->assertStatus(401);
    }

    public function test_authenticated_quotes_endpoint_response(): void
    {
        $token = (new Token)->create();
        
        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}"
        ])->get('/api/quotes');

        $response->assertStatus(200);
    }

    public function test_authenticated_quotes_endpoint_response_array_total(): void
    {
        $token = (new Token)->create();

        $standardResponse = $this->withHeaders([
            'Authorization' => "Bearer {$token}"
        ])->get('/api/quotes');

        $this->assertCount(5, $standardResponse['quotes']);

        $limitResponse = $this->withHeaders([
            'Authorization' => "Bearer {$token}"
        ])->get('/api/quotes?limit=8');

        $this->assertCount(8, $limitResponse['quotes']);
    }
}
