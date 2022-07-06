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
    public function errorAction(): Response
    {
        return $this->render('catch_error/index.html.twig', [
            'controller_name' => 'CatchErrorController',
        ]);
    }

    /**
     * @Route("/catch", name="catch_error_action")
     */
    public function catchErrorAction(): Response
    {
        return $this->render('catch_error/catch.html.twig', [
            'controller_name' => 'CatchErrorController',
        ]);
    }

    /**
     * @Route("/errorChangePass", name="error_change_pass")
     */
    public function errorChangePassAction(): Response
    {
        return $this->render('catch_error/errorChangePass.html.twig', [
            'controller_name' => 'CatchErrorController',
        ]);
    }
}
