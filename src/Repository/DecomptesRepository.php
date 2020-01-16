<?php

namespace App\Repository;

use App\Entity\Decomptes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Decomptes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Decomptes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Decomptes[]    findAll()
 * @method Decomptes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DecomptesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Decomptes::class);
    }

    // /**
    //  * @return Decomptes[] Returns an array of Decomptes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Decomptes
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
