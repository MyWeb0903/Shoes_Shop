<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatchErrorController extends AbstractController
{
    /**
     * @Route("/catch/error", name="catch_error")
     */
    public function index(): Response
    {
        return $this->render('catch_error/index.html.twig', [
            'controller_name' => 'CatchErrorController',
        ]);
    }
}
