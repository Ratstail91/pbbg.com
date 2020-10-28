<?php

namespace Tests\Feature\Feeds;

use Tests\TestCase;

class GetFeedsTest extends TestCase
{
    /**
     * Get list of games
     *
     * @return void
     */
    public function testGetFeeds()
    {
        $this->withoutExceptionHandling();
        $response = $this->withHeaders(['Accept' => 'application/json'])->get('/feeds');
        $this->assertResponse($response, 200);
    }
}
