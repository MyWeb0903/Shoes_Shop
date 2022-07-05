<?php

namespace App\Repository;

use App\Entity\Feadback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Feadback>
 *
 * @method Feadback|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feadback|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feadback[]    findAll()
 * @method Feadback[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeadbackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feadback::class);
    }

    public function add(Feadback $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Feadback $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Feadback[] Returns an array of Feadback objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Feadback
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


   /**
    * @return Feadback[] Returns an array of Feadback objects
    */
   public function showUID(): array
   {
       return $this->createQueryBuilder('f')
            ->select('u.id as ID')
            ->innerJoin('f.User', 'u')
            ->getQuery()
            ->getResult()
       ;
   }


}
