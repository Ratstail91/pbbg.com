<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function registerUser($uuid = null) {
        $uuid = $uuid ?: uniqid();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/register', [
            'name' => 'User_' . $uuid,
            'email' => 'foo_' . $uuid . '@bar.baz',
            'password' => 'foobarbaz'
        ]);
        $response_json = json_decode($response->content());
        $token = $response_json->token;
        $this->assertNotEquals('', $token); # improve this to check that token is valid JWT
        return $token;
    }
}
