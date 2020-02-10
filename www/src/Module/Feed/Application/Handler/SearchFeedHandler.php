<?php


namespace App\Module\Feed\Application\Handler;


use App\Module\Feed\Application\Mapper\FeedMapper;
use App\Module\Feed\Application\Query\SearchFeedQuery;
use App\Module\Feed\Domain\Feed;
use App\Module\Feed\Infrastructure\Repository\FeedRepository;
use Doctrine\Common\Collections\ArrayCollection;

class SearchFeedHandler
{
    private FeedRepository $repository;
    private FeedMapper $feedMapper;

    public function __construct(FeedRepository $repository, FeedMapper $feedMapper)
    {
        $this->repository = $repository;
        $this->feedMapper = $feedMapper;
    }

    /**
     * @param SearchFeedQuery $query
     * @return ArrayCollection
     */
    public function handle(SearchFeedQuery $query): ArrayCollection
    {
        return $this
            ->repository
            ->searchBy($query)
            ->map(fn (Feed $feed) => $this->feedMapper->toDTO($feed));
    }

}