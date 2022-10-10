<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/index", name="home_page")
     */
    public function homeAction(ProductRepository $repo): Response
    {   
        $products = $repo->findAll();
        return $this->render('home/index.html.twig', [
            'products' => $products
        ]);
    }
}
