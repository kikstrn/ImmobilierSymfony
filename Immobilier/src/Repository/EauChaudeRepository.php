<?php

namespace App\Repository;

use App\Entity\EauChaude;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EauChaude|null find($id, $lockMode = null, $lockVersion = null)
 * @method EauChaude|null findOneBy(array $criteria, array $orderBy = null)
 * @method EauChaude[]    findAll()
 * @method EauChaude[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EauChaudeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EauChaude::class);
    }

    // /**
    //  * @return EauChaude[] Returns an array of EauChaude objects
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
    public function findOneBySomeField($value): ?EauChaude
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
