<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Http\Resources\Feed as FeedResource;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feed_items = [];

        $unlinked_feeds = [
            'pbbg.com' => [
                'address'   => 'https://blog.pbbg.com/rss/',
                'url'       => 'https://discourse.pbbg.com',
                'image_url' => 'https://blog.pbbg.com/favicon.png',
            ],
            '/r/PBBG' => [
                'address'   => 'https://www.reddit.com/r/PBBG/.rss',
                'url'       => 'https://www.reddit.com/r/PBBG',
                'image_url' => 'https://s3.amazonaws.com/pbbg-site/assets/reddit.png'
            ]
        ];

        foreach ($unlinked_feeds as $name => $feed) {
            $this_result = \Feeds::make($feed['address']);
            $these_items = $this_result->get_items();
            $these_items = array_slice($these_items, 0, 3);
            foreach ($these_items as $this_item) {
                array_push($feed_items, [
                    'url' => $this_item->get_permalink(),
                    'feed_name' => $name,
                    'feed_source' => $feed['url'],
                    'image_url' => $feed['image_url'],
                    'title' => $this_item->get_title(),
                    'timestamp' => $this_item->get_gmdate('U')
                ]);
            }
        }

        usort($feed_items, array(FeedController::class, 'sortByTimestamp'));

        $feed_items = array_slice($feed_items, 0, 6);

        return [
            'data' => $feed_items
        ];
    }

    private static function sortByTimestamp($a, $b)
    {
        return $b['timestamp'] - $a['timestamp'];
    }
}
