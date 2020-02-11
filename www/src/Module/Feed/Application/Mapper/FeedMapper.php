<?php


namespace App\Module\Feed\Application\Mapper;


use App\Module\Feed\Application\DTO\FeedDTO;
use App\Module\Feed\Domain\Feed;

class FeedMapper
{
    private FeedItemMapper $itemMapper;
    private FeedImageMapper $imageMapper;

    public function __construct(FeedItemMapper $itemMapper, FeedImageMapper $imageMapper)
    {
        $this->itemMapper = $itemMapper;
        $this->imageMapper = $imageMapper;
    }

    public function toDTO(Feed $feed): FeedDTO
    {
        $dto = new FeedDTO();
        $dto->id = $feed->getId();
        $dto->title = $feed->getTitle();
        $dto->description = $feed->getDescription();
        $dto->image = $feed->getImage() ? $this->imageMapper->toDTO($feed->getImage()) : null;
        $dto->link = $feed->getLink();
        $dto->copyright = $feed->getCopyright();
        $dto->item = [];

        foreach ($feed->getItems() as $item) {
            $dto->item[] = $this->itemMapper->toDTO($item);
        }

        return $dto;
    }
}