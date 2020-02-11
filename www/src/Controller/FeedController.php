<?php

namespace App\Controller;

use App\Module\Feed\Application\Handler\SearchFeedHandler;
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

    public function feedItem($item): JsonResponse
    {
        return $this->json([]);
    }

    public function feedList(Request $request, SearchFeedHandler $handler): JsonResponse
    {
        $searchQuery = new SearchFeedQuery();
        $searchQuery->description = $request->get('description');
        $searchQuery->title = $request->get('title');
        $searchQuery->offset = $request->get('offset', 0);
        $searchQuery->limit = $request->get('limit', 10);

        return $this->json($handler->handle($searchQuery));
    }
}