<?php


namespace App\Module\Feed\Application\DTO;


class FeedItemDTO
{

    /**
     * @var string|null
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
     * @var string[]
     */
    public $category;

    /**
     * @var string
     */
    public $pub_date;
}