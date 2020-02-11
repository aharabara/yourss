<?php

namespace App\Command;

use App\Module\Feed\Application\Handler\GatherFeedItemsCommand;
use App\Module\Feed\Application\Handler\GatherFeedItemsHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FeedGathererCommand extends Command
{
    protected static $defaultName = 'feed:gather';

    private GatherFeedItemsHandler $gatherFeedItemsHandler;

    public function __construct(string $name = null, GatherFeedItemsHandler $gatherFeedItemsHandler)
    {
        parent::__construct($name);
        $this->gatherFeedItemsHandler = $gatherFeedItemsHandler;
    }

    protected function configure()
    {
        $this->addArgument('limit', InputArgument::REQUIRED, 'Amount of feed to handle.');
        $this->addArgument('page', InputArgument::REQUIRED, 'Used to calculate offset from $limit * $page');
        $this->addArgument('last-update-before', InputArgument::REQUIRED, 'Get items that were updated before $lastUpdateBefore. (time string)');
        parent::configure();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $page = $input->getArgument('page');
        $limit = $input->getArgument('limit');
        $lastUpdateBefore = (new \DateTimeImmutable())->modify($input->getArgument('last-update-before'));

        $page = $page > 0 ? $page : 1;
        $limit = $limit > 0 ? $limit : 1;

        $command = new GatherFeedItemsCommand();
        $command->lastUpdateBefore = $lastUpdateBefore;
        $command->limit = $limit;
        $command->offset = ($page - 1) * $limit;
        $this->gatherFeedItemsHandler->handle($command);
        return 0;
    }
}