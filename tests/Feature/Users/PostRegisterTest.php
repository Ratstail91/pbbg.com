<?php

namespace Tests\Feature\Users;

use Tests\TestCase;

class PostRegisterTest extends TestCase
{
    /**
     * A user can register with correct input
     *
     * @return void
     */
    public function testPostRegisterWithCorrectInput()
    {
        $response = $this->post('/register', [
            'name' => 'User_' . uniqid(),
            'email' => 'foo_' . uniqid() . '@bar.baz',
            'password' => 'foobarbaz'
        ]);

        $this->assertResponse($response, 200);
    }

    /**
     * A user cannot register with incorrect input
     *
     * @return void
     */
    public function testPostRegisterWithIncorrectInput()
    {
        $response = $this->post('/register', [
            'name' => 'User_' . uniqid(),
            'email' => 'foo_' . uniqid() . '@bar.baz',
            'password' => 'foobar'
        ]);

        $this->assertResponse($response, 422);
    }

    /**
     * A user cannot register with empty input
     *
     * @return void
     */
    public function testPostRegisterWithEmptyInput()
    {
        $response = $this->post('/register');
        $this->assertResponse($response, 422);
    }
}
