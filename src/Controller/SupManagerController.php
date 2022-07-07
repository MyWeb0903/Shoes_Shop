<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupManagerController extends AbstractController
{
    /**
     * @Route("/supmanager", name="sup_manager")
     */
    public function sup_managerAction(): Response
    {
        return $this->render('SupManager/index.html.twig', [
            'controller_name' => 'SupManagerController',
        ]);
    }

}