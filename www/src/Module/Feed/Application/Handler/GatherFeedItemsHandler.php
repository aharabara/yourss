<?php


namespace App\Module\Feed\Application\Handler;


use App\Module\Feed\Application\DocumentDTO;
use App\Module\Feed\Application\Mapper\FeedItemMapper;
use App\Module\Feed\Domain\Feed;
use App\Module\Feed\Infrastructure\Repository\FeedRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GatherFeedItemsHandler
{
    private FeedRepository $repository;
    private LoggerInterface $logger;
    private FeedItemMapper $itemMapper;
    private SerializerInterface $serializer;
    /**
     * @var HttpClientInterface
     */
    private HttpClientInterface $httpClient;

    public function __construct(
        FeedRepository $repository,
        FeedItemMapper $itemMapper,
        LoggerInterface $logger,
        SerializerInterface $serializer,
        HttpClientInterface $httpClient
    )
    {
        $this->repository = $repository;
        $this->logger = $logger;
        $this->itemMapper = $itemMapper;
        $this->serializer = $serializer;
        $this->httpClient = $httpClient;
    }

    /**
     * @param GatherFeedItemsCommand $command
     * @return void
     */
    public function handle(GatherFeedItemsCommand $command): void
    {
        $feeds = $this->repository->getFeedsToUpdate($command->lastUpdateBefore, $command->offset, $command->limit);
        $feeds->map(function (Feed $feed) {
            /** @var DocumentDTO $document */
            $payload = $this->httpClient->request('GET', $feed->getLink())->getContent();
            $document = $this->serializer->deserialize($payload, DocumentDTO::class, 'xml');
            if (!empty($document->channel->item)) {
                foreach ($document->channel->item as $item) {
                    if (!$feed->hasItem($item->link)) {
                        $itemModel = $this->itemMapper->toModel($item);
                        $feed->addItem($itemModel);
                        $this->logger->info("Loading feed: {$feed->getTitle()}. Item : {$itemModel->getTitle()} was added.");
                    }
                }
            } else {
                throw new \LogicException("Feed '{$feed->getTitle()}' is inaccessible. Cannot unserialize document from '{$feed->getLink()}'.");
            }
            $this->repository->save($feed);
        });
    }
}