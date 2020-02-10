<?php


namespace App\Module\Feed\Application\Mapper;


use App\Module\Feed\Application\DTO\FeedDTO;
use App\Module\Feed\Domain\Feed;

class FeedMapper
{
    private FeedItemMapper $itemMapper;

    public function __construct(FeedItemMapper $mapper)
    {
        $this->itemMapper = $mapper;
    }

    public function toDTO(Feed $feed): FeedDTO
    {
        $dto = new FeedDTO();
        $dto->id = $feed->getId();
        $dto->title = $feed->getTitle();
        $dto->description = $feed->getDescription();
        $dto->link = $feed->getLink();
        $dto->copyright = $feed->getCopyright();
        $dto->items = [];

        foreach ($feed->getItems() as $item) {
            $dto->items[] = $this->itemMapper->toDTO($item);
        }

        return $dto;
    }
}