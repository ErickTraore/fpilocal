<?php

namespace App\Repository;

use App\Entity\Tablesection3;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;


/**
 * @method Tablesection3|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tablesection3|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tablesection3[]    findAll()
 * @method Tablesection3[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Tablesection3Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tablesection3::class);
    }

   
    /**
    * @return Tablesection3[] Returns an array of Tablesection3 objects
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
    public function findOneBySomeField($value): ?Tablesection3
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
