<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;
use App\Entity\PropertySearch;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
    * @return Query
    * 
    */
    public function FindAllVisibleQuery(PropertySearch $search): Query
    {
        $query =  $this->FindVisibleQuery();

        // if ($search->getMaxPrice())
        // {
        //     $query = $query
        //                 ->andWhere('p.price < :maxprice')
        //                 ->setParameter('maxprice',$search->getMaxPrice());
        // }
        // if ($search->getMinSurface())
        // {
        //     $query = $query
        //                 ->andWhere('p.surface < :minsurface')
        //                 ->setParameter('minsurface',$search->getMinSurface());
        // }

        if ($search->getOptionns()->count() > 0) {
            foreach ($search->getOptionns() as $k => $optionn) {
                $query = $query
                            ->andWhere(":optionn MEMBER OF p.optionns")
                            ->setParameter("optionn", $optionn);
            }
        }
                     return $query->getQuery();

    }
    /**
    * @return Property[]
    * 
    */
    public function FindLatest(): array
    {
        return $this->FindVisibleQuery()
        ->setMaxResults(4)
        ->getQuery()
        ->getResult();

    }

    private function FindVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
        ->where('p.sold = false' );

    }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
