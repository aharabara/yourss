<?php

namespace App\Module\Feed\Application\Handler;


use App\Module\Feed\Application\Mapper\FeedItemMapper;
use App\Module\Feed\Application\Query\SearchFeedItemQuery;
use App\Module\Feed\Domain\FeedItem;
use App\Module\Feed\Infrastructure\Repository\FeedItemRepository;

class SearchFeedItemHandler
{
    private FeedItemRepository $repository;
    private FeedItemMapper $mapper;

    public function __construct(FeedItemRepository $repository, FeedItemMapper $mapper)
    {
        $this->repository = $repository;
        $this->mapper = $mapper;
    }

    public function handle(SearchFeedItemQuery $query)
    {
        return $this
            ->repository
            ->searchBy($query)
            ->map(fn(FeedItem $item) => $this->mapper->toDTO($item));
    }

}