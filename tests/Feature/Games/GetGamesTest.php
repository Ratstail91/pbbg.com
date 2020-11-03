<?php

namespace Tests\Feature\Games;

use Tests\TestCase;

class GetGamesTest extends TestCase
{
    /**
     * Get list of games
     *
     * @return void
     */
    public function testGetGames()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/games');

        $this->assertResponse($response, 200);
    }
}
