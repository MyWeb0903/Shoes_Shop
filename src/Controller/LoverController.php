<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoverController extends AbstractController
{
    /**
     * @Route("/lover", name="lover_page")
     */
    public function loverAction(): Response
    {
        return $this->render('lover/index.html.twig', [
            'controller_name' => 'LoverController',
        ]);
    }
}
