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
    public function testGetGamesReturnsCorrectHttpResponse()
    {
        $response = $this->get('/games');
        $this->assertResponse($response, 200);
    }

    public function testGetGamesReturnsCorrectData()
    {
        $response = $this->get('/games');
        $response_content = json_decode($response->getContent());
        $this->assertSchema($response_content, 'games.json');
    }
}
