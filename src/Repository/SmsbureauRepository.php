<?php

namespace App\Repository;

use App\Entity\Smsbureau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Smsbureau|null find($id, $lockMode = null, $lockVersion = null)
 * @method Smsbureau|null findOneBy(array $criteria, array $orderBy = null)
 * @method Smsbureau[]    findAll()
 * @method Smsbureau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SmsbureauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Smsbureau::class);
    }

    // /**
    //  * @return Smsbureau[] Returns an array of Smsbureau objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Smsbureau
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
