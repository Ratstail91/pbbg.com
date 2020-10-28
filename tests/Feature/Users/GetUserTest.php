<?php

namespace Tests\Feature\Users;

use Tests\TestCase;

class GetUserTest extends TestCase
{
    /**
     * Get user by id
     *
     * @return void
     */
    public function testGetUser()
    {
        $response = $this->get('/users/1');
        $this->assertResponse($response, 200);
    }
}
