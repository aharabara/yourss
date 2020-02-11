<?php


namespace App\Module\Feed\Application\Handler;


use App\Module\Feed\Application\DTO\FeedDTO;
use App\Module\Feed\Application\Mapper\FeedMapper;
use App\Module\Feed\Application\Query\GetFullFeedQuery;
use App\Module\Feed\Infrastructure\Repository\FeedRepository;

class GetFullFeedHandler
{
    private FeedRepository $repository;
    private FeedMapper $mapper;

    public function __construct(
        FeedRepository $repository,
        FeedMapper $mapper
    )
    {
        $this->repository = $repository;
        $this->mapper = $mapper;
    }

    /**
     * @param GetFullFeedQuery $query
     * @return FeedDTO|null
     */
    public function handle(GetFullFeedQuery $query): ?FeedDTO
    {
        $feed = $this->repository->find($query->id);
        return $feed !== null ? $this->mapper->toDTO($feed) : null;
    }
}