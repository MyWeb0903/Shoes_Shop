<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cart>
 *
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function add(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Cart[] Returns an array of Cart objects
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

//    public function findOneBySomeField($value): ?Cart
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


    /**
    * @return Cart[] Returns an array of Cart objects
    */
   public function showCart($user, $cid): array
   {
       return $this->createQueryBuilder('c')
            ->select('p.Image, p.Name, cd.Qty_Product as Quantity, p.Price, cd.id as id')
            ->innerJoin('c.user', 'u')
            ->innerJoin('c.Contains', 'cd')
            ->innerJoin('cd.product', 'p')
            ->Where('c.user = :uid')
            ->setParameter('uid', $user)
            ->andWhere('c.id = :cid')
            ->setParameter('cid', $cid)
            ->getQuery()
            ->getArrayResult()
       ;
   }

       /**
    * @return Cart[] Returns an array of Cart objects
    */
    public function sumPrice($user, $cid): array
    {
        return $this->createQueryBuilder('c')
             ->select('Sum(p.Price * cd.Qty_Product) as Total')
             ->innerJoin('c.user', 'u')
             ->innerJoin('c.Contains', 'cd')
             ->innerJoin('cd.product', 'p')
             ->Where('c.user = :uid')
             ->setParameter('uid', $user)
             ->andWhere('c.id = :cid')
             ->setParameter('cid', $cid)
             ->getQuery()
             ->getArrayResult()
        ;
    }


    //        /**
    // * @return Cart[] Returns an array of Cart objects
    // */
    // public function getCartID($user): array
    // {
    //     return $this->createQueryBuilder('c')
    //          ->select('c.id')
    //          ->where('c.id = :user')
    //          ->setParameter('user', $user)
    //          ->getQuery()
    //          ->getArrayResult()
    //     ;
    // }
}
