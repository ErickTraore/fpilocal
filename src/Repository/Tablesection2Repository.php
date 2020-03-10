<?php

namespace App\Repository;

use App\Entity\Tablesection2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;


/**
 * @method Tablesection2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tablesection2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tablesection2[]    findAll()
 * @method Tablesection2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Tablesection2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tablesection2::class);
    }

   
    /**
    * @return Tablesection2[] Returns an array of Tablesection2 objects
    */
    public function findByTitre()
    {
        return $this->createQueryBuilder('t')
             ->where('(t.titre) < 2')
            ->getQuery()
            ->getResult()
        ;
    }
    /*
    public function findOneBySomeField($value): ?Tablesection2
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
