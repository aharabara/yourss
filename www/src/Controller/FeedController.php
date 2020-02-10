<?php

namespace App\Controller;

use App\Module\Feed\Application\Handler\SearchFeedHandler;
use App\Module\Feed\Application\Query\SearchFeedQuery;
use App\Module\Feed\Domain\Document;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class FeedController extends AbstractController
{
    public function test(SerializerInterface $serializer, DecoderInterface $encoder)
    {
        $url = 'https://www.who.int/feeds/entity/csr/don/en/rss.xml';
        /** @var Document $feed */
        $feed = $serializer->deserialize(file_get_contents($url), Document::class, 'xml');
        return $this->json($feed);
    }

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