<?php

namespace App\Repository;

use App\Entity\AchatReg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AchatReg|null find($id, $lockMode = null, $lockVersion = null)
 * @method AchatReg|null findOneBy(array $criteria, array $orderBy = null)
 * @method AchatReg[]    findAll()
 * @method AchatReg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AchatRegRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AchatReg::class);
    }

    // /**
    //  * @return AchatReg[] Returns an array of AchatReg objects
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
    public function findOneBySomeField($value): ?AchatReg
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
