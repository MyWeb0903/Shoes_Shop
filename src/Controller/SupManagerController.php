<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupManagerController extends AbstractController
{
    /**
     * @Route("/supmanager", name="sup_manager")
     */
    public function adminAction(): Response
    {
        return $this->render('SupManager/index.html.twig', [
            'controller_name' => 'SupManagerController',
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