<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search_page", methods={"POST"})
     */
    public function searchAction(ProductRepository $repo, Request $req): Response
    {
        $search = $req -> request -> get('search');
        $product = $repo->getProductByName($search);

        return $this->render('search/index.html.twig', [
            'product' => $product
        ]);
    }


}
