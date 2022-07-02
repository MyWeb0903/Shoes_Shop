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
        return $this->render('home/basedemo.html.twig', [
=======
        return $this->render('home/index.html.twig', [
>>>>>>> Duy
            'controller_name' => 'HomeController',
        ]);
    }
}
