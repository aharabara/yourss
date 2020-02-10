<?php

namespace App\Module\Feed\Application\Query;

use Symfony\Component\Validator\Constraints as Assert;

class SearchFeedItemQuery
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
     * @Assert\Type(type="string[]")
     * @var string[]
     */
    public $categories;

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

    /**
     * @Assert\GreaterThan(value="0")
     * @Assert\Type(type="DateTimeImmutable")
     * @var \DateTimeImmutable
     */
    public $pubDate;
}