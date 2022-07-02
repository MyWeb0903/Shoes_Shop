<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile_page")
     */
    public function profireAction(UserRepository $repo): Response
    {
        // $get =  $this->getUser();
        // $user = $get;
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $profile = $repo->getUserAccount($user);
        return $this->render('profile/index.html.twig', [
            'profile' => $profile
        ]);
        // return $this->json($profile);
    }
}
