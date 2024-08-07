<?php

namespace Tests\Feature;

use Tests\TestCase;
use AvrilloCodeTest\AuthToken\Token;

class TokenTest extends TestCase
{
    public function test_token_endpoint_returns_successful_response(): void
    {
        $response = $this->get('/api/generate-token');

        $response->assertStatus(200);
    }

    public function test_token_endpoint_returns_string(): void
    {
        $response = $this->get('/api/generate-token');

        $this->assertIsString($response['token']);
    }

    public function test_token_endpoint_stores_result(): void
    {
        $response = $this->get('/api/generate-token');

        $response->assertJson(['token' => (new Token)->get()]);
    }

    public function test_token_endpoint_returns_unsuccessful_response(): void
    {
        $response = $this->post('/api/generate-token');

        $response->assertStatus(405);
    }
}
