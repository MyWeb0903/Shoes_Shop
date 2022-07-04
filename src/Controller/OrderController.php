<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Form\Type\OrderType;
use App\Repository\CartRepository;
use App\Repository\ContainRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

date_default_timezone_set("Asia/Ho_Chi_Minh");
class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="app_order")
     */
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    // /**
    //  * @Route("/countCart", name="countCartAction")
    //  */
    // public function countCartAction(ContainRepository $repo, CartRepository $cartRepo, ProductRepository $proRepo,
    //     OrderRepository $orderRepo): Response
    // {
    //     $user = $this->getUser();
    //     $cart = $cartRepo->findOneBy(['user' => $user]);
    //     // $getCart = $repo->getProID($cart);
    //     // $cont = $proRepo->ProductID($getCart);
    //     $OrderID = $orderRepo->getOrderID($user);
    //     $id = $OrderID[0]['OrderID'];

        
    //     // $cont = $repo->findAllContain($cart);
    //     return $this->json($id);
    // }

    /**
     * @Route("/addOrder", name="add_order")
     */
    public function addOrderAction(ManagerRegistry $res, CartRepository $cartRepo, UserRepository $uRepo,
        ContainRepository $contRepo, OrderRepository $orderRepo, ProductRepository $proRepo): Response
    {
        $order = new Order();
        $entity = $res->getManager();

        $user = $this->getUser();
        $cart = $cartRepo->findOneBy(['user' => $user]);

        $curDate = new \DateTime();
        $curDate->format('H:i:s \O\n Y-m-d');

        $getCart = $cartRepo->sumPrice($user, $cart);

        $get = $uRepo->get($user);

        $address = $get[0]['address'];
        $phone = $get[0]['phone'];

        $order->setOrderDate($curDate);
        $order->setPayment($getCart[0]['Total']);
        $order->setAddress($address);
        $order->setPhone($phone);
        $order->setUser($user);


        $entity->persist($order);
        $entity->flush();

        //add to orderdetail
        $cont = $contRepo->countContain($cart);
        $get = $cont[0]['CountCart'];

        $OrderID = $orderRepo->getOrderID($user);
        $getOrder = $OrderID[0]['OrderID'];

        $n = $orderRepo->find($getOrder);



        if($get != 0){
            for($i = 0; $i < $get; $i++){
                $orderDetail = new OrderDetail();

                $getCart = $contRepo->getProID($cart);
                $quantity = $getCart[$i]['quantity'];
        
                $proID = $getCart[$i]['ProductID'];
                $m = $proRepo->find($proID);

                $orderDetail->setQtyPro($quantity);
                $orderDetail->setOrderID($n);
                $orderDetail->setProduct($m);

                $entity->persist($orderDetail);
                $entity->flush();

            
                $k = $getCart[$i]['ProQty'];

                $m->setQuantity($k - $quantity);

                $entity->persist($m);
                $entity->flush();
            }
        }
        else{
            return $this->json('No product to order!');
        }

        return  $this->redirectToRoute('product_page');
    }

}
