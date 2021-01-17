<?php

namespace App\Repository;

use App\Entity\MainProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MainProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainProduct[]    findAll()
 * @method MainProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainProduct::class);
    }

        public function findAll()
    {
        return $this->findBy(array(), array('category' => 'ASC'));
    }

    // /**
    //  * @return MainProduct[] Returns an array of MainProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MainProduct
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
