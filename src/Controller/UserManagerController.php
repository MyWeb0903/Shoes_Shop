<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

date_default_timezone_set("Asia/Ho_Chi_Minh");
class UserManagerController extends AbstractController
{
    /**
     * @Route("/usermanager", name="user_manager")
     */
    public function user_managerAction(UserRepository $repo): Response
    {
        $user = $repo->findAll();
        return $this->render('UserManager/index.html.twig', [
            'user' => $user
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