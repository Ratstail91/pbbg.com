<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetAuthenticatedUserTest extends TestCase
{
    /**
     * An authenticated user can access their user data
     *
     * @return void
     */
    public function testAnAuthenticatedUserCanAccessAuthenticatedUserData()
    {
        $token = $this->registerUser();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => "Bearer $token"
        ])->get('/user');
        $response->assertStatus(200);
    }

    /**
     * An unauthenticated user cannot access user data
     *
     * @return void
     */
    public function testAnUnauthenticatedUserCanNotAccessAuthenticatedUserData()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => "Bearer InvalidToken"
        ])->get('/user');
        $response->assertStatus(401);
    }

}
