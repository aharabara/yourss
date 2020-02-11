<?php

namespace App\Module\Feed\Domain;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @ORM\Entity(repositoryClass="App\Module\Feed\Infrastructure\Repository\FeedItemRepository")
 */
class FeedItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int|null
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Feed", inversedBy="item")
     * @ORM\JoinColumn(name="feed_id", referencedColumnName="id")
     * @var Feed
     */
    private $feed;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $link;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="json")
     * @var string[]|null
     */
    private $category = [];

    /**
     * @ORM\Column(type="datetime_immutable")
     * @var DateTimeImmutable
     */
    private $pubDate;

    public function __construct()
    {
        $this->pubDate = $this->pubDate ?? new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string[]
     */
    public function getCategory(): array
    {
        return $this->category;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getPubDate(): DateTimeImmutable
    {
        return $this->pubDate;
    }

    /**
     * @param Feed $feed
     */
    public function setFeed(Feed $feed): void
    {
        $this->feed = $feed;
    }
}
