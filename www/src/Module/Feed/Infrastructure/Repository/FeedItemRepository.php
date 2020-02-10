<?php

namespace App\Module\Feed\Infrastructure\Repository;

use App\Module\Feed\Application\Query\SearchFeedItemQuery;
use App\Module\Feed\Domain\FeedItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FeedItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method FeedItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method FeedItem[]    findAll()
 * @method FeedItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FeedItem::class);
    }

    /**
     * @param SearchFeedItemQuery $query
     * @return ArrayCollection
     */
    public function searchBy(SearchFeedItemQuery $query): ArrayCollection
    {
        $queryBuilder = $this->createQueryBuilder('feed_item');

        if (!empty($query->title)) {
            $queryBuilder
                ->where('feed_item.title like :title')
                ->setParameter(':title', $query->title);
        }

        if (!empty($query->description)) {
            $queryBuilder
                ->where('feed_item.description like :description')
                ->setParameter(':description', $query->description);
        }

        if (!empty($query->categories)) {
            $queryBuilder
                ->where('feed_item.categories IN (:categories)')
                ->setParameter(':categories', $query->categories);
        }

        if (!empty($query->categories)) {
            $queryBuilder
                ->where('feed_item.pub_date = :pub_date')
                ->setParameter(':pub_date', $query->pubDate);
        }

        $feedItems = $queryBuilder
            ->setMaxResults($query->limit)
            ->setFirstResult($query->offset)
            ->getQuery()
            ->getResult();

        return new ArrayCollection($feedItems);
    }
}
