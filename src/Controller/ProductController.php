<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product_page")
     */
    public function productAction(ProductRepository $product): Response
    {
        return $this->render('product/index.html.twig', [
            'product_form' => $product,
        ]);
    }
}
