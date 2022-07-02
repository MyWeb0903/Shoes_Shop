<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

date_default_timezone_set("Asia/Ho_Chi_Minh");
class CartController extends AbstractController
{
    /**
     * @Route("/cart{id}", name="cart_page", methods={"POST"})
     */
    public function cartAction(ManagerRegistry $res, ProductRepository $proRepo, CartRepository $cartRepo, $id): Response
    {
        $cart = new Cart();
        $entity = $res->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user->getId();
        $product = $proRepo->find($id);

        $cart->setQuantity_Pro(1);
        $cart->setUser($user);
        $cart->setProducts($product);

        $entity->persist($cart);
        $entity->flush();

        return $this->render('cart/index.html.twig');
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

    // /**
    //  * @Route("/showCart", name="showCart")
    //  */
    // public function showCartAction(CartRepository $repo): Response
    // {
    //     $user = $this->get('security.token_storage')->getToken()->getUser();
    //     $cart = $repo->getCart($user);
    //     return $this->render('cart/index.html.twig', [
    //         'cart' => $cart
    //     ]);
    // }
}
