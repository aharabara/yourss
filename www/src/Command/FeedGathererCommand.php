<?php

namespace App\Command;

use App\Module\Feed\Application\DocumentDTO;
use App\Module\Feed\Application\Mapper\FeedItemMapper;
use App\Module\Feed\Infrastructure\Repository\FeedRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\SerializerInterface;

class FeedGathererCommand extends Command
{

    /**
     * @var FeedRepository
     */
    private $feedRepository;

    protected static $defaultName = 'feed:gather';
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;
    /**
     * @var FeedItemMapper
     */
    private FeedItemMapper $itemMapper;
    /**
     * @var string
     */
    private string $name;

    public function __construct(
        string $name = null,
        FeedItemMapper $itemMapper,
        SerializerInterface $serializer,
        FeedRepository $feedRepository
    )
    {
        parent::__construct($name);
        $this->feedRepository = $feedRepository;
        $this->serializer = $serializer;
        $this->itemMapper = $itemMapper;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $feeds = $this->feedRepository->findAll();
        foreach ($feeds as $feed) {
            $output->writeln("Loading feed: <comment>{$feed->getTitle()}</comment>");
            /** @var DocumentDTO $document */
            $document = $this->serializer->deserialize(file_get_contents($feed->getLink()), DocumentDTO::class, 'xml');
            /* @TODO save items */
            if (!empty($document->channel->item)) {
                foreach ($document->channel->item as $item) {
                    /** @fixme move to handler*/
                    if(!$feed->hasItem($item->link)){
                        $itemModel = $this->itemMapper->toModel($item);
                        $feed->addItem($itemModel);
                        $output->writeln("<info> - {$itemModel->getTitle()}</info> was added.");
                    }
                }
            }
            $this->feedRepository->save($feed);
        }
        return 0;
    }
}