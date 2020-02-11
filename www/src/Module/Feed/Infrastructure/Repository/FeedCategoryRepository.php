<?php

namespace App\Module\Feed\Infrastructure\Repository;

use App\Module\Feed\Domain\FeedCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FeedCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method FeedCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method FeedCategory[]    findAll()
 * @method FeedCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedCategoryRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FeedCategory::class);
    }
}
