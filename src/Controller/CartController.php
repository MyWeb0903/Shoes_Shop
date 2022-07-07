<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

date_default_timezone_set("Asia/Ho_Chi_Minh");
class CartController extends AbstractController
{
    /**
     * @Route("/showcart", name="showcart")
     */
    public function cartAction(CartRepository $repo): Response
    {
        $user = $this->getUser();

        $cart = $repo->findOneBy(['user' => $user]);
        $ca = $repo->showCart($user, $cart);

        $price = $repo->sumPrice($user, $cart);
        $total = $price[0]['Total'];

        return $this->render('cart/index.html.twig', [
            'cart' => $ca,
            'total' => $total
        ]);

        // return $this->array($total);
    }
}
