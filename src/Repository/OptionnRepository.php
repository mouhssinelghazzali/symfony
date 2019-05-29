<?php

namespace App\Repository;

use App\Entity\Optionn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Optionn|null find($id, $lockMode = null, $lockVersion = null)
 * @method Optionn|null findOneBy(array $criteria, array $orderBy = null)
 * @method Optionn[]    findAll()
 * @method Optionn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptionnRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Optionn::class);
    }

    // /**
    //  * @return Optionn[] Returns an array of Optionn objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Optionn
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
