<?php


namespace App\Module\Feed\Application\Mapper;


use App\Module\Feed\Application\DTO\FeedImageDTO;
use App\Module\Feed\Domain\FeedImage;

class FeedImageMapper
{

    /**
     * @param FeedImage $image
     * @return FeedImageDTO
     */
    public function toDTO(FeedImage $image): FeedImageDTO {

        $dto = new FeedImageDTO();
        $dto->id = $image->getId();
        $dto->link = $image->getTitle();
        $dto->title = $image->getTitle();

        return $dto;
    }
}