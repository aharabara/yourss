<?php


namespace App\Module\Feed\Application\DTO;


use Symfony\Component\Serializer\Annotation\Groups;

class FeedDTO
{

    /**
     * @var int|null
     * @Groups({"feed.list", "feed.full"})
     */
    public $id;

    /**
     * @var string
     * @Groups({"feed.list", "feed.full"})
     */
    public $title;

    /**
     * @var string
     * @Groups({"feed.list", "feed.full"})
     */
    public $description;

    /**
     * @var string
     * @Groups({"feed.list", "feed.full"})
     */
    public $link;

    /**
     * @var FeedImageDTO
     * @Groups({"feed.list", "feed.full"})
     */
    public $image;

    /**
     * @var string
     * @Groups({"feed.full"})
     */
    public $copyright;

    /**
     * @var FeedItemDTO[]
     * @Groups({"feed.full"})
     */
    public $item;
}