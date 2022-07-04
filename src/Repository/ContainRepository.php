<?php

namespace App\Repository;

use App\Entity\Contain;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contain>
 *
 * @method Contain|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contain|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contain[]    findAll()
 * @method Contain[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContainRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contain::class);
    }

    public function add(Contain $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Contain $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Contain[] Returns an array of Contain objects
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

//    public function findOneBySomeField($value): ?Contain
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


   /**
    * @return Contain[] Returns an array of Contain objects
    */
   public function checkQty($proid, $cartid): array
   {
       return $this->createQueryBuilder('c')
            ->select('Count(c.id) as count, c.Qty_Product as quantity, c.id as id')
            ->innerJoin('c.product', 'p')
            ->innerJoin('c.cart', 'cart')
            ->andWhere('p.id = :proid')
            ->setParameter('proid', $proid)
            ->andWhere('cart.id = :cartid')
            ->setParameter('cartid', $cartid)
            ->getQuery()
            ->getResult()
        ;
   }

   
   /**
    * @return Contain[] Returns an array of Contain objects
    */
   public function countContain($caID): array
   {
       return $this->createQueryBuilder('c')
            ->select('Count(c.id) as CountCart')
            ->innerJoin('c.cart', 'ca')
            ->where('ca.id = :id')
            ->setParameter('id', $caID)
            ->getQuery()
            ->getResult()
       ;
   }


      /**
    * @return Contain[] Returns an array of Contain objects
    */
    public function getProID($caID): array
    {
        return $this->createQueryBuilder('c')
             ->select('c.Qty_Product as quantity, p.id as ProductID, p.Quantity as ProQty')
             ->innerJoin('c.cart', 'ca')
             ->where('ca.id = :id')
             ->setParameter('id', $caID)
             ->innerJoin('c.product', 'p')
             ->getQuery()
             ->getResult()
        ;
    }


}
