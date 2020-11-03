<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        $user = User::factory()->create([
            'password' => Hash::make($password = 'password'),
        ]);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
        $this->assertResponse($response, 200);
    }

    /**
     * A user cannot log in with invalid credentials
     *
     * @return void
     */
    public function testPostLogInWithInvalidCredentials()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/login', [
            'email' => 'foo_' . uniqid() . '@bar.baz',
            'password' => 'incorrectpassword'
        ]);
        $this->assertResponse($response, 401);
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
        $this->assertResponse($response, 422);
    }
}
