<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostLoginTest extends TestCase
{
    /**
     * A user can log in with valid credentials
     *
     * @return void
     */
    public function testPostLogInWithValidCredentials()
    {
        $uuid = uniqid();
        $this->registerUser($uuid);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/login', [
            'email' => 'foo_' . $uuid . '@bar.baz',
            'password' => 'foobarbaz',
        ]);
        $response->assertStatus(200);
    }

    /**
     * A user cannot log in with invalid credentials
     *
     * @return void
     */
    public function testPostLogInWithInvalidCredentials()
    {
        $uuid = uniqid();
        $this->registerUser($uuid);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/login', [
            'email' => 'foo_' . $uuid . '@bar.baz',
            'password' => 'incorrectpassword'
        ]);
        $response->assertStatus(401);
    }

    /**
     * A user cannot log in with empty credentials
     *
     * @return void
     */
    public function testPostLogInWithEmptyCredentials()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/login');
        $response->assertStatus(422);
    }
}
