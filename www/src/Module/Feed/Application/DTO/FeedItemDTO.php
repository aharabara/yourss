<?php


namespace App\Module\Feed\Application\DTO;


use Symfony\Component\Serializer\Annotation\Groups;

class FeedItemDTO
{

    /**
     * @var string|null
     * @Groups({"feed.full"})
     */
    public $id;

    /**
     * @var string
     * @Groups({"feed.full"})
     */
    public $title;

    /**
     * @Groups({"feed.full"})
     * @var string
     */
    public $description;

    /**
     * @var string
     * @Groups({"feed.full"})
     */
    public $link;

    /**
     * @var string[]
     * @Groups({"feed.full"})
     */
    public $category;

    /**
     * @var string
     * @Groups({"feed.full"})
     */
    public $pub_date;
}