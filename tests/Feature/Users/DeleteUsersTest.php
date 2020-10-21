<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteUsersTest extends TestCase
{
    /**
     * Get list of users
     *
     * @return void
     */
    public function testDeleteUsers()
    {
        $this->registerUser();
        # user count should be greater than 0

        $count = User::count();
        $this->assertGreaterThan(0,$count);

        $response = $this->withHeaders(['Accept' => 'application/json'])->delete('/users');
        $this->assertResponse($response, 200);

        $count = User::count();
        $this->assertEquals(0,$count);
    }
}
