<?php

namespace App\Controller;

use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_page")
     */
    public function cartAction(): Response
    {
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    // /**
    //  * @Route("/product/{id}", name="get_cart")
    //  */
    // public function getCartAction(ProductRepository $repo, $id): Response
    // {
    //     $product = $repo->find($id);
    //     return $this->render('cart/index.html.twig', [
    //         'p' => $product
    //     ]);
    // }

    /**
     * @Route("/showCart/{user}", name="showCart")
     */
    public function showCartAction(CartRepository $repo, $user): Response
    {
        $cart = $repo->getCart($user);
        return $this->render('cart/index.html.twig', [
            'p' => $cart
        ]);
    }
}
