<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product_page")
     */
    public function productAction(ProductRepository $repo): Response
    {
        
        return $this->render('product/index.html.twig', [
            'product' => $repo
        ]);
    }

    /**
     * @Route("/product/{id}", name="detail_page")
     */
    public function detailAction(ProductRepository $repo, $id): Response
    {
        $product = $repo->find($id);
        return $this->render('product/detail.html.twig', [
            'p' => $product
        ]);
    }
}
