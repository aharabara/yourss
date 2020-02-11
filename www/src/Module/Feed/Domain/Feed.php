<?php

namespace App\Module\Feed\Domain;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToOne(targetEntity="FeedImage")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     * @var FeedImage
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $copyright;

    /**
     * @ORM\OneToMany(targetEntity="\App\Module\Feed\Domain\FeedItem", mappedBy="feed", cascade={"persist"})
     * @var FeedItem[]|ArrayCollection
     */
    private $item;

    public function __construct()
    {
        $this->item = new ArrayCollection();
    }

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
     * @return FeedItem[]|ArrayCollection
     */
    public function getItems(): ArrayCollection
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
        $item->setFeed($this);
    }

    /**
     * @return FeedImage|null
     */
    public function getImage(): ?FeedImage
    {
        return $this->image;
    }

    /**
     * @param string $link
     * @return bool
     */
    public function hasItem(string $link): bool
    {
        foreach ($this->item as $item) {
            if ($item->getLink() === $link){
                return true;
            }
        }
        return false;
    }

}
