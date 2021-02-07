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
    public function testGetGameReturnsCorrectHttpResponse()
    {
        $response = $this->get('/games/1');
        $this->assertResponse($response, 200);
    }

    public function testGetGameReturnsCorrectData()
    {
        $response = $this->get('/games/1');
        $response_content = json_decode($response->getContent());
        $this->assertSchema($response_content, 'game.json');
    }
}
