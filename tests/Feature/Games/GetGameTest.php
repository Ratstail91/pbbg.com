<?php

namespace Tests\Feature\Games;

use Tests\TestCase;

class GetGameTest extends TestCase
{
    /**
     * Get game by id
     *
     * @return void
     */
    public function testGetGame()
    {
        $response = $this->get('/games/1');
        $this->assertResponse($response, 200);
    }
}
