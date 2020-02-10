<?php

namespace App\Module\Feed\Domain;

class Document
{
    /**
     * @var Feed
     */
    private $channel;

    /**
     * @return Feed
     */
    public function getChannel(): Feed
    {
        return $this->channel;
    }
}
