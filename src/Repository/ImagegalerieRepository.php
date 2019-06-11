<?php

namespace App\Repository;

use App\Entity\Imagegalerie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Imagegalerie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Imagegalerie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Imagegalerie[]    findAll()
 * @method Imagegalerie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagegalerieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Imagegalerie::class);
    }

    // /**
    //  * @return Imagegalerie[] Returns an array of Imagegalerie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Imagegalerie
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
