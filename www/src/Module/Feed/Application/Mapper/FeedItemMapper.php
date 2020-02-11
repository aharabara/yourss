<?php


namespace App\Module\Feed\Application\Mapper;

use App\Module\Feed\Application\DTO\FeedItemDTO;
use App\Module\Feed\Domain\FeedItem;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class FeedItemMapper
{
    private DenormalizerInterface $denormalizer;

    public function __construct(DenormalizerInterface $denormalizer)
    {
        $this->denormalizer = $denormalizer;
    }

    public function toDTO(FeedItem $item): FeedItemDTO
    {
        $dto = new FeedItemDTO();
        $dto->id = $item->getId();
        $dto->title = $item->getTitle();
        $dto->description = $item->getDescription();
        $dto->link = $item->getLink();
        $dto->category = $item->getCategory();
        $dto->pub_date = $item->getPubDate()->format('Y-m-d');

        return $dto;
    }

    public function toModel(FeedItemDTO $dto): FeedItem
    {
        /** @var FeedItem $item */
        $item = $this->denormalizer->denormalize($dto, FeedItem::class);
        return $item;
    }
}