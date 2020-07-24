<?php

namespace App\Repository;

use App\Entity\JsonDataEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JsonDataEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method JsonDataEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method JsonDataEntity[]    findAll()
 * @method JsonDataEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JsonDataEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JsonDataEntity::class);
    }

    // /**
    //  * @return JsonDataEntity[] Returns an array of JsonDataEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JsonDataEntity
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
