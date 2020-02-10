<?php

namespace App\Module\Feed\Infrastructure\Repository;

use App\Module\Feed\Application\Query\SearchFeedQuery;
use App\Module\Feed\Domain\Feed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Feed|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feed|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feed[]    findAll()
 * @method Feed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feed::class);
    }

    /**
     * @param SearchFeedQuery $query
     * @return ArrayCollection
     */
    public function searchBy(SearchFeedQuery $query): ArrayCollection
    {
        $queryBuilder = $this->createQueryBuilder('feed');

        if (!empty($query->title)) {
            $queryBuilder
                ->where('feed.title like :title')
                ->setParameter(':title', $query->title);
        }

        if (!empty($query->description)) {
            $queryBuilder
                ->where('feed.description like :description')
                ->setParameter(':description', $query->description);
        }

        $feeds = $queryBuilder
            ->setMaxResults($query->limit)
            ->setFirstResult($query->offset)
            ->getQuery()
            ->getResult();

        return new ArrayCollection($feeds);
    }
}
