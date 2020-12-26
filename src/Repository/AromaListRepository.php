<?php

namespace App\Repository;

use App\Entity\AromaList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AromaList|null find($id, $lockMode = null, $lockVersion = null)
 * @method AromaList|null findOneBy(array $criteria, array $orderBy = null)
 * @method AromaList[]    findAll()
 * @method AromaList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AromaListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AromaList::class);
    }

    // /**
    //  * @return AromaList[] Returns an array of AromaList objects
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
    public function findOneBySomeField($value): ?AromaList
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
