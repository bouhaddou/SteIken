<?php

namespace App\Repository;

use App\Entity\Avenant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Avenant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Avenant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Avenant[]    findAll()
 * @method Avenant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvenantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Avenant::class);
    }

    // /**
    //  * @return Avenant[] Returns an array of Avenant objects
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
    public function findOneBySomeField($value): ?Avenant
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
