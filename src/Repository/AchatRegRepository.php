<?php

namespace App\Repository;

use App\Entity\AchatReg;
use App\Entity\Fournisseurs;
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

  
    public function findByAchatReg(Fournisseurs $frs)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.fournisseur = :val')
            ->setParameter('val', $frs)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findVenteByFrs(Fournisseurs $frs,$type)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.fournisseur = :val')
            ->andWhere('a.type = :va')
            ->setParameter('val', $frs)
            ->setParameter('va',$type)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
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
