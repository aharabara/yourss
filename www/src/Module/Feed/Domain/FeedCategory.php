<?php

namespace App\Module\Feed\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Module\Feed\Infrastructure\Repository\FeedCategoryRepository")
 */
class FeedCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int|null
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $title;

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
}
