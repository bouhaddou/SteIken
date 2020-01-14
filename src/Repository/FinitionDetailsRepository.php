<?php

namespace App\Repository;

use App\Entity\Finition;
use App\Entity\FinitionDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FinitionDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method FinitionDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method FinitionDetails[]    findAll()
 * @method FinitionDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinitionDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FinitionDetails::class);
    }
    public function  findFinition(Finition $fini)
    {
        return $this->createQueryBuilder("p")
                    ->where("p.Finitions = :fini")
                    ->setParameter("fini", $fini)
                    ->orderBy("p.id","DESC")
                    ->getQuery()
                    ->getResult();
    }

    // /**
    //  * @return FinitionDetails[] Returns an array of FinitionDetails objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FinitionDetails
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
