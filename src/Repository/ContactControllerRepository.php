<?php

namespace App\Repository;

use App\Entity\ContactController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContactController>
 *
 * @method ContactController|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactController|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactController[]    findAll()
 * @method ContactController[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactControllerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactController::class);
    }

//    /**
//     * @return ContactController[] Returns an array of ContactController objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ContactController
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
