<?php

namespace App\Repository;

use App\Entity\Regelement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Regelement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Regelement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Regelement[]    findAll()
 * @method Regelement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegelementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Regelement::class);
    }

    // /**
    //  * @return Regelement[] Returns an array of Regelement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Regelement
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
