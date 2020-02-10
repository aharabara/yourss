<?php

namespace App\Controller;

use App\Module\Feed\Domain\Document;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    public function feedList(): JsonResponse
    {
        return $this->json([]);
    }
}