<?php

namespace App\Repository;

use App\Entity\Compt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Compt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Compt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Compt[]    findAll()
 * @method Compt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComptRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Compt::class);
    }

    // /**
    //  * @return Compt[] Returns an array of Compt objects
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
    public function findOneBySomeField($value): ?Compt
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
