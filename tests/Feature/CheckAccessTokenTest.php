<?php

namespace Tests\Feature;

use Tests\TestCase;

class CheckAccessTokenTest extends TestCase
{
    /**
     * @test
     * @group check-access-token
     */
    public function user_cannot_access_any_route_without_access_token_in_request()
    {
        $response = $this->get('/api/v1/cards');
        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Invalid access token',
        ]);
    }
}
