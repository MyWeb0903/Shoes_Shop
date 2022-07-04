<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        // $user = $this->getUser();
        $order = $repo->findAll();
        // $userID = $uRepo->getUserID($user);
        // $getID = $userID[0]['User_ID'];
        return $this->render('OrderManager/index.html.twig', [
            'order' => $order
            // 'userID' => $getID
        ]);
    }

}