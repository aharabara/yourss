<?php

namespace App\Controller;

use App\Module\Feed\Application\Handler\GetFullFeedHandler;
use App\Module\Feed\Application\Handler\SearchFeedHandler;
use App\Module\Feed\Application\Query\GetFullFeedQuery;
use App\Module\Feed\Application\Query\SearchFeedQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FeedController extends AbstractController
{

    public function feedTags(): JsonResponse
    {
        return $this->json([]);
    }

    /**
     * @param Request $request
     * @param GetFullFeedHandler $handler
     * @return JsonResponse
     */
    public function feed(Request $request, GetFullFeedHandler $handler): JsonResponse
    {
        $query = new GetFullFeedQuery();
        $query->id = $request->attributes->get('id');

        $feed = $handler->handle($query);
        if (!$feed) {
            return $this->json(null, 404);
        }
        return $this->json($feed, 200, [], ['groups' => ['feed.full']]);
    }

    /**
     * @param Request $request
     * @param SearchFeedHandler $handler
     * @return JsonResponse
     */
    public function feedList(Request $request, SearchFeedHandler $handler): JsonResponse
    {
        $searchQuery = new SearchFeedQuery();
        $searchQuery->description = $request->get('description');
        $searchQuery->title = $request->get('title');
        $searchQuery->offset = $request->get('offset', 0);
        $searchQuery->limit = $request->get('limit', 10);

        return $this->json($handler->handle($searchQuery), 200, [], ['groups' => ['feed.list']]);
    }
}