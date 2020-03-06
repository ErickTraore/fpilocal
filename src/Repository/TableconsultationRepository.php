<?php

namespace App\Repository;

use App\Entity\Tableconsultation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;


/**
 * @method Tableconsultation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tableconsultation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tableconsultation[]    findAll()
 * @method Tableconsultation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TableconsultationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tableconsultation::class);
    }

   
    /**
    * @return Tableconsultation[] Returns an array of Tableconsultation objects
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
    public function findOneBySomeField($value): ?Tableconsultation
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
