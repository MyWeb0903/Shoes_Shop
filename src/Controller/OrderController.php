<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\Type\OrderType;
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

    /**
     * @Route("/addOrder", name="addOrder")
     */
    public function addOrderAction(ManagerRegistry $res, Request $req): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($req);
        $entity = $res->getManager();

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $order->setOrderDate(new \DateTime());
            $order->setDeliveryDate(new \DateTime());
            $order->setPayment($data->getPayment());
            $order->setStatus($data->getStatus());
            $order->setPhone($data->getPhone());
            $order->setUser($data->getUser());

            $entity->persist($order);
            $entity->flush();

            return $this->json([
                'id' => $order->getId()
            ]);
        }

        return $this->render('order/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
