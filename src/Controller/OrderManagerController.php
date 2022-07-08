<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
date_default_timezone_set("Asia/Ho_Chi_Minh");
class OrderManagerController extends AbstractController
{
    /**
     * @Route("/ordermanager", name="order_manager")
     */
    public function order_managerAction(OrderRepository $repo): Response
    {
        $order = $repo->findAll();

        return $this->render('OrderManager/index.html.twig', [
            'order' => $order
        ]);
    }


    /**
     * @Route("/confirmOrder/{id}", name="confirm")
     */
    public function confirmOrderAction($id, ManagerRegistry $res, OrderRepository $repo): Response
    {
        $entity = $res->getManager();
        $order = $repo->find($id);

        $date = New \DateTime();
        $status = 'Delivery';
        
        $order->setDeliveryDate($date); 
        $order->setStatus($status);

        $entity->persist($order);
        $entity->flush();

        return $this->redirectToRoute('order_manager');
    }

}