<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
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
        $search = $req -> request -> get('search-txt');
        $product = $repo->getProductByName($search);
        $items = count($product);
        return $this->render('search/index.html.twig', [
            'products' => $product,
            'keyword' => $search,
            'items' => $items

        ]);
    }

}
