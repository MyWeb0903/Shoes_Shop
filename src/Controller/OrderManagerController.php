<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderManagerController extends AbstractController
{
    /**
     * @Route("/ordermanager", name="order_manager")
     */
    public function adminAction(): Response
    {
        return $this->render('OrderManager/index.html.twig', [
            'controller_name' => 'OrderManagerController',
        ]);
    }

    // /**
    //  * @Route("/adminManager/{id}", name="get_catemanager")
    //  */
    // public function getCateManagerAction(ProductRepository $repo, $id): Response
    // {
    //     $product = $repo->find($id);
    //     return $this->render('CateManager/index.html.twig', [
    //         'p' => $product
    //     ]);
    // }
}