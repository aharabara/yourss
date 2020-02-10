<?php


namespace App\Module\Feed\Application\Query;


class SearchFeedQuery
{

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     * */
    public $description;

    /**
     * @Assert\GreaterThan(value="0")
     * @Assert\Type(type="int")
     */
    public $limit = 10;

    /**
     * @Assert\GreaterThan(value="0")
     * @Assert\Type(type="int")
     */
    public $offset = 0;
}