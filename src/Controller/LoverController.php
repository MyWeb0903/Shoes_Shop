<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\CartRepository;
use Doctrine\Persistence\ManagerRegistry;

class LoverController extends AbstractController
{
    /**
     * @Route("/lover", name="lover_page")
     */
    public function loverAction(): Response
    {
        return $this->render('lover/index.html.twig', [
            'controller_name' => 'LoverController',
        ]);
    }

    // /**
    //  * @Route("/love/{id}", name="get_lover"
    //  */
    // public function getLoverAction(ManagerRegistry $res, $id, CartRepository $cRepo): Response
    // {
    //     $entity = $res->getManager();

    //     $user = $this->getUser();
    //     $cart = $cRepo->findOneBy(['user' => $user]);
    //     $n = $cRepo->getUserID($cart);
    //     $k = $n[0]['ID'];

    //     $p1 = $entity->getRepository(Product::class)->find($id);
    //     $p2 = $entity->getRepository(User::class)->find($k);

    //     $product = new Product();
    //     $uID = new User();

    //     $product->addUser($p2);
    //     $uID->addProductID($p1);

    //     $entity->persist($product);
    //     $entity->persist($uID);
    //     $entity->flush();

    //     return $this->redirectToRoute('product_page');
    // }
}
