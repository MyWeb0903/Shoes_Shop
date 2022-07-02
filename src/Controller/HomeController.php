<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home_page")
     */
    public function homeAction(): Response
    {
        return $this->render('home/basedem.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
