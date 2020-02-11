<?php


namespace App\Module\Feed\Application\Handler;

use DateTimeImmutable;

class GatherFeedItemsCommand
{
    public ?DateTimeImmutable $lastUpdateBefore;

    public int $offset = 0;
    public int $limit = 10;
}