<?php

namespace App\Module\Feed\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass="App\Module\Feed\Infrastructure\Repository\FeedRepository")
 * @ORM\HasLifecycleCallbacks()
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

    /**
     * @ORM\Column(type="datetime_immutable")
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @var \DateTimeImmutable
     */
    private $updatedAt;

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
     * @return FeedItem[]|ArrayCollection|PersistentCollection
     */
    public function getItems(): Collection
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

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

}
