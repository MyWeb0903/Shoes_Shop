<?php

namespace App\Repository;

use App\Entity\OrderDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderDetail>
 *
 * @method OrderDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderDetail[]    findAll()
 * @method OrderDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderDetail::class);
    }

    public function add(OrderDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OrderDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OrderDetail[] Returns an array of OrderDetail objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrderDetail
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


   /**
    * @return OrderDetail[] Returns an array of OrderDetail objects
    */
   public function showOrderdetail($id): array
   {
       return $this->createQueryBuilder('o')
            ->select('o.id as ID, o.Qty_Pro as Quantity, od.id as OrderID, p.id as ProID')
            ->innerJoin('o.product', 'p')
            ->innerJoin('o.Order_ID', 'od')
            ->where('o.Order_ID = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
       ;
   }


    //  /**
    //  * @return OrderDetail[]
    //  */
    // public function showOrderdetail($id)
    // {
    //     $OD = $this->getEntityManager();
    //     return $OD->createQuery('
    //         Select o.id, o.Qty_Pro, or.id as Order_ID, p.id as ProID 
    //         from App\Entity\OrderDetail o, App\Entity\Order or, App\Entity\Product p
    //         where  o.Order_ID = or.id and o.product = p.id and or.id = :id
    //     ')
    //     ->setParameter('id', $id)
    //     ->getResult();
    // }
   
}
