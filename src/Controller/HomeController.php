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
<<<<<<< HEAD
        // return $this->render('home/index.html.twig', [
=======
        //return $this->render('home/index.html.twig', [
>>>>>>> Huynh
        return $this->render('home/basedemo.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
