<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UpdatePasswordType;
use App\Repository\CartRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile_page")
     */
    public function profireAction(UserRepository $repo): Response
    {
        $user = $this->getUser();
        // $user = $get;
        $profile = $repo->getUserAccount($user);
        return $this->render('profile/index.html.twig', [
            'profile' => $profile
        ]);
    }

    /**
     * @Route("/password", name="password")
     */
    public function passwordAction(): Response
    {   
        return $this->render('profile/confirmOldPass.html.twig', [
            'controller_name' => 'Controller',
        ]);
    }


    /**
     * @Route("/passwordold", name="passwordold")
     */
    public function passwordOldAction(Request $req, UserPasswordHasherInterface $hasher): Response
    {   
        $user = $this->getUser();
        $oldPass = $req -> request -> get('txt');

        $get = $hasher->isPasswordValid($user, $oldPass);
        $n = 0;
        if($get == true){
            $n = 1;
        }
        
        return $this->redirectToRoute('change_Pass');
    }


    /**
     * @Route("/changePass", name="change_Pass")
     */
    public function change_PassAction(Request $req, ManagerRegistry $res, UserRepository $repo, 
    UserPasswordHasherInterface $hasher, CartRepository $cRepo): Response
    {   
        $user = $this->getUser();
        $cart = $cRepo->findOneBy(['user' => $user]);
        $n = $cRepo->getUserID($cart);

        $k = $n[0]['ID'];

        $user = $repo->find($k);
        $form = $this->createForm(UpdatePasswordType::class, $user);



        $form->handleRequest($req);
        $entity = $res->getManager();

       
        if($form->isSubmitted() && $form->isValid()){
            $user->setPassword($hasher->hashPassword($user, 
            $form->get('password')->getData()));

            $entity->persist($user);
            $entity->flush();

            return $this->redirectToRoute('profile_page');
        }

        return $this->render('profile/ChangePass.html.twig', [
            'form' => $form->createView()
        ]);
    }

    
}
