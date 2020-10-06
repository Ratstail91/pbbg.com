<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A user can register with correct input
     *
     * @return void
     */
    public function testAUserCanRegisterWithCorrectInput()
    {
        $random_uuid = uniqid();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/register', [
            'name' => 'User_' . $random_uuid,
            'email' => 'foo_' . $random_uuid . '@bar.baz',
            'password' => 'foobarbaz'
        ]);
        $response->assertStatus(200);
    }

    /**
     * A user cannot register with incorrect input
     *
     * @return void
     */
    public function testAUserCannotRegisterWithIncorrectInput()
    {
        $random_uuid = uniqid();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/register', [
            'name' => 'User_' . $random_uuid,
            'email' => 'foo_' . $random_uuid . '@bar.baz',
            'password' => 'foobar'
        ]);

        $response->assertStatus(422);
    }

    /**
     * A user can log in with valid credentials
     *
     * @return void
     */
    public function testAUserCanLogInWithValidCredentials()
    {
        $random_uuid = uniqid();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/register', [
            'name' => 'User_' . $random_uuid,
            'email' => 'foo_' . $random_uuid . '@bar.baz',
            'password' => 'foobarbaz'
        ]);
        $response_json = json_decode($response->content());
        $token = $response_json->token;
        $this->assertNotEquals('', $token); # improve this to check that token is valid JWT

        $response = $this->post('/login', [
            'email' => 'foo_' . $random_uuid . '@bar.baz',
            'password' => 'foobarbaz',
        ]);
        $response->assertStatus(200);
    }

    /**
     * A user cannot log in with invalid credentials
     *
     * @return void
     */
    public function testAUserCannotLogInWithInvalidCredentials()
    {
        $random_uuid = uniqid();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/register', [
            'name' => 'User_' . $random_uuid,
            'email' => 'foo_' . $random_uuid . '@bar.baz',
            'password' => 'foobarbaz'
        ]);
        $response_json = json_decode($response->content());
        $token = $response_json->token;
        $this->assertNotEquals('', $token); # improve this to check that token is valid JWT

        $response = $this->post('/login', [
            'email' => 'foo_' . $random_uuid . '@bar.baz',
            'password' => 'incorrectpassword'
        ]);
        $response->assertStatus(401);
    }

    /**
     * Am authenticated user can access the user page
     *
     * @return void
     */
    public function testAnAuthenticatedUserCanAccessTheUserPage()
    {
        $random_uuid = uniqid();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/register', [
            'name' => 'User_' . $random_uuid,
            'email' => 'foo_' . $random_uuid . '@bar.baz',
            'password' => 'foobarbaz'
        ]);
        $response_json = json_decode($response->content());
        $token = $response_json->token;
        $this->assertNotEquals('', $token); # improve this to check that token is valid JWT

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('/user');
        $response->assertStatus(200);
    }

    /**
     * An unauthenticated user cannot access the user page
     *
     * @return void
     */
    public function testAnUnauthetnicatedUserCannotAccessTheUserPage()
    {
        $random_uuid = uniqid();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/register', [
            'name' => 'User_' . $random_uuid,
            'email' => 'foo_' . $random_uuid . '@bar.baz',
            'password' => 'foobarbaz'
        ]);
        $response_json = json_decode($response->content());
        $token = $response_json->token;
        $this->assertNotEquals('', $token); # improve this to check that token is valid JWT

        $response = $this->get('/user');
        $response->assertStatus(401);

        $response = $this->withHeaders([
            'Authorization' => "Bearer InvalidToken"
        ])->get('/user');
        $response->assertStatus(401);
    }

}
