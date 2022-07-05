<?php

namespace App\Controller;

use App\Entity\Feadback;
use App\Entity\User;
use App\Repository\CartRepository;
use App\Repository\FeadbackRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeadbackController extends AbstractController
{
    /**
     * @Route("/feadback", name="app_feadback")
     */
    public function feadbackAction(FeadbackRepository $repo): Response
    {
        $feedback = $repo->findAll();

        return $this->render('feadback/index.html.twig', [
            'feedback' => $feedback
        ]);
    }

    /**
     * @Route("/addFeadback", name="add_feadback", methods={"POST"})
     */
    public function addFeadbackAction(ManagerRegistry $res, Request $req): Response
    {
        $getUname = $req ->request -> get('user-txt');
        $getEmail = $req ->request -> get('email-txt');
        $getPhone = $req ->request -> get('phone-txt');
        $getMess = $req ->request -> get('message-txt');
        $getProName = $req ->request -> get('product-txt');

        $user = $this->getUser();
       

        $feadback = new Feadback();
        $entity = $res->getManager();

        $feadback->setUsername($getUname);
        $feadback->setEmail($getEmail);
        $feadback->setPhone($getPhone);
        $feadback->setProductName($getProName);
        $feadback->setMessage($getMess);
        $feadback->setUser($user);



        $entity->persist($feadback);
        $entity->flush();
        
        return $this->redirectToRoute('about_page');
    }
}
