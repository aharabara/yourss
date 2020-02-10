<?php

namespace App\Module\Feed\Infrastructure\Repository;

use App\Module\Feed\Domain\FeedImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FeedImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method FeedImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method FeedImage[]    findAll()
 * @method FeedImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FeedImage::class);
    }
}
