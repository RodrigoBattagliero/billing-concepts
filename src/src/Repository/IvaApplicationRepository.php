<?php

namespace App\Repository;

use App\Entity\IvaApplication;
use App\Interface\IvaApplicationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IvaApplication>
 */
class IvaApplicationRepository extends ServiceEntityRepository implements IvaApplicationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IvaApplication::class);
    }

    public function getAll(): ?array
    {
        return $this->createQueryBuilder('i')
            ->getQuery()
            ->getResult()
            ;
    }


    public function getById(int $id): ?IvaApplication
    {
        return $this->createQueryBuilder('i')
            ->andWhere('t = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
            ;
    }

    public function update()
    {

    }
    public function delete(){

    }

    //    /**
    //     * @return IvaApplication[] Returns an array of IvaApplication objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?IvaApplication
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
