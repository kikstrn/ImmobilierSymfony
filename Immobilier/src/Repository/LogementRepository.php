<?php

namespace App\Repository;

use App\Entity\Logement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Logement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Logement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Logement[]    findAll()
 * @method Logement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Logement::class);
    }

    // /**
    //  * @return Logement[] Returns an array of Logement objects
    //  */

    public function findLogement($value)
    {
        return $this->createQueryBuilder('l')
            ->innerJoin('l.chauffage','ch','WITH', 'ch.id = l.chauffage')
            ->innerJoin('l.eauChaude','eau','WITH', 'eau.id = l.eauChaude')
            ->innerJoin('l.localisation','loc','WITH', 'loc.id = l.localisation')
            ->innerJoin('l.typeLogement','type','WITH', 'type.id = l.typeLogement')
            ->innerJoin('l.vente','vente','WITH', 'vente.id = l.vente')
            ->andWhere('l.nombrePiece LIKE :val')
            ->orWhere('l.prix LIKE :val')
            ->orWhere('l.surfaceTotale LIKE :val')
            ->orWhere('l.description LIKE :val')
            ->orWhere('l.depot LIKE :val')
            ->orWhere('l.proximite LIKE :val')
            ->orWhere('ch.nomChauffage LIKE :val')
            ->orWhere('eau.nomEauChaude LIKE :val')
            ->orWhere('loc.nomLocalisation LIKE :val')
            ->orWhere('type.nomTypeLogement LIKE :val')
            ->orWhere('vente.vente LIKE :val')
            ->setParameter('val', "%".$value."%")
            ->getQuery()
            ->getResult()
        ;
    }



    public function findOneLogement($id): ?Logement
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
