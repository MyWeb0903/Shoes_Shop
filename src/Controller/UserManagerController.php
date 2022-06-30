<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserManagerController extends AbstractController
{
    /**
     * @Route("/usermanager", name="user_manager")
     */
    public function adminAction(): Response
    {
        return $this->render('UserManager/index.html.twig', [
            'controller_name' => 'UserManagerController',
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