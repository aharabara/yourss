<?php

namespace App\Module\Feed\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Module\Feed\Infrastructure\Repository\FeedRepository")
 */
class Feed
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $link;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $copyright;

    /**
     * @ORM\OneToMany(targetEntity="\App\Module\Feed\Domain\FeedItem", mappedBy="feed")
     * @var FeedItem[]
     */
    private $item = [];

    public function getId(): ?int
    {
        return $this->id;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getCopyright(): string
    {
        return $this->copyright;
    }

    /**
     * @return FeedItem[]
     */
    public function getItem(): array
    {
        return $this->item;
    }

    /**
     * @param FeedItem $item
     * @return void
     */
    public function addItem(FeedItem $item): void
    {
        $this->item[] = $item;
    }

}
