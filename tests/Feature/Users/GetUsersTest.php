<?php

namespace Tests\Feature\Users;

use Tests\TestCase;

class GetUsersTest extends TestCase
{
    /**
     * Get list of users
     *
     * @return void
     */
    public function testGetUsers()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->get('/users');
        $this->assertResponse($response, 200);
    }
}
