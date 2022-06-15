<?php

namespace App\Repository;

use App\Entity\AnnounceSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnnounceSearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnnounceSearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnnounceSearch[]    findAll()
 * @method AnnounceSearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnounceSearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnnounceSearch::class);
    }

    // /**
    //  * @return AnnounceSearch[] Returns an array of AnnounceSearch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnnounceSearch
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
