<?php


namespace App\Module\Feed\Application\DTO;


class FeedDTO
{

    /**
     * @var int|null
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $link;

    /**
     * @var string
     */
    public $copyright;

    /**
     * @var FeedItemDTO[]
     */
    public $items;
}