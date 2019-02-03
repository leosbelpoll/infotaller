<?php

namespace App\Repository;

use App\Entity\ClassVehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClassVehicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassVehicle|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassVehicle[]    findAll()
 * @method ClassVehicle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassVehicleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClassVehicle::class);
    }

    // /**
    //  * @return ClassVehicle[] Returns an array of ClassVehicle objects
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
    public function findOneBySomeField($value): ?ClassVehicle
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
