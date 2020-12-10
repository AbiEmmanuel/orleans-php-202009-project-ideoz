<?php

namespace App\Repository;

use App\Entity\Testimonye;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Testimonye|null find($id, $lockMode = null, $lockVersion = null)
 * @method Testimonye|null findOneBy(array $criteria, array $orderBy = null)
 * @method Testimonye[]    findAll()
 * @method Testimonye[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestimonyeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Testimonye::class);
    }

    // /**
    //  * @return Testimonye[] Returns an array of Testimonye objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Testimonye
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
