<?php

namespace Tests\Feature\Feeds;

use Tests\TestCase;

class GetFeedsTest extends TestCase
{
    /**
     * Get list of feeds
     *
     * @return void
     */
    public function testGetFeeds()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/feeds');
        $this->assertResponse($response, 200);
    }
}
