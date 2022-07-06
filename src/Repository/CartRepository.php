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
   public function showCart($userId, $cartId): array
   {
       return $this->createQueryBuilder('cart')
            ->select('product.Name, product.id, product.Image, product.Price, product.Detail, contain.Qty_Product as Quantity')
            ->innerJoin('cart.Contains', 'contain')
            ->innerJoin('cart.user', 'user')
            ->innerJoin('contain.product', 'product')
            ->Where('cart.user = :userId')
            ->setParameter('userId', $userId)
            ->andWhere('cart.id = :cartId')
            ->setParameter('cartId', $cartId)
            ->getQuery()
            ->getArrayResult()
       ;
   }

       /**
    * @return Cart[] Returns an array of Cart objects
    */
    public function sumPrice($userId, $cartId): array
    {
        return $this->createQueryBuilder('cart')
            ->select('Sum(product.Price * contain.Qty_Product) as totalPrice, Sum(contain.Qty_Product) as totalQuantity')
            ->innerJoin('cart.Contains', 'contain')
            ->innerJoin('contain.product', 'product')
            ->innerJoin('cart.user', 'user')
            ->Where('cart.user = :userId')
            ->setParameter('userId', $userId)
            ->andWhere('cart.id = :cartId')
            ->setParameter('cartId', $cartId)
            ->getQuery()
            ->getResult()
        ;
    }


           /**
    * @return Cart[] Returns an array of Cart objects
    */
    public function getUserID($cid): array
    {
        return $this->createQueryBuilder('c')
             ->select('u.id as ID')
             ->innerJoin('c.user', 'u')
             ->where('c.id = :cid')
             ->setParameter('cid', $cid)
             ->getQuery()
             ->getArrayResult()
        ;
    }


    
}
