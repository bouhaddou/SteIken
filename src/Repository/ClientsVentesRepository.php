<?php

namespace App\Repository;

use App\Entity\ClientsPar;
use App\Entity\ClientsVentes;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method ClientsVentes|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientsVentes|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientsVentes[]    findAll()
 * @method ClientsVentes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientsVentesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientsVentes::class);
    }




    public function findByventes(
         $frs)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.clients = :val')
            ->setParameter('val', $frs)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findVenteByClients(ClientsPar $frs,$type)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.clients = :val')
            ->andWhere('a.type = :va')
            ->setParameter('val', $frs)
            ->setParameter('va',$type)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return ClientsVentes[] Returns an array of ClientsVentes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClientsVentes
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
