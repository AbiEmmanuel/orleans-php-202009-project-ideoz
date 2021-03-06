<?php

namespace App\Repository;

use App\Entity\Ecosystem;
use App\Entity\EcosystemSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ecosystem|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ecosystem|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ecosystem[]    findAll()
 * @method Ecosystem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcosystemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ecosystem::class);
    }

    public function findLikeName(EcosystemSearch $ecosystemSearch): array
    {
        $queryBuilder = $this->createQueryBuilder('e');

        if (!empty($ecosystemSearch->getInput())) {
            $queryBuilder
                ->where('e.name LIKE :name')
                ->setParameter('name', '%' . $ecosystemSearch->getInput() . '%');
        }
        if (!empty($ecosystemSearch->getCompetences())) {
            $queryBuilder
                ->join('e.competences', 'c')
                ->orWhere('c.id IN(:competences)')
                ->setParameter('competences', $ecosystemSearch->getCompetences());
        }

        return $queryBuilder->getQuery()->getResult();
    }

    // /**
    //  * @return Ecosystem[] Returns an array of Ecosystem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ecosystem
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
