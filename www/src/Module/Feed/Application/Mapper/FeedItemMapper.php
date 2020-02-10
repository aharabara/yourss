<?php


namespace App\Module\Feed\Application\Mapper;

use App\Module\Feed\Application\DTO\FeedItemDTO;
use App\Module\Feed\Domain\FeedItem;

class FeedItemMapper
{

    public function toDTO(FeedItem $item): FeedItemDTO {
        $dto = new FeedItemDTO();
        $dto->id = $item->getId();
        $dto->title = $item->getTitle();
        $dto->description = $item->getDescription();
        $dto->link = $item->getLink();
        $dto->pub_date = $item->getPubDate()->format('Y-m-d');

        return $dto;
    }
}