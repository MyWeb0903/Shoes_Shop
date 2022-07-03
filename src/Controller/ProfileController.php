<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UpdatePasswordType;
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
     * @Route("/changePass/{id}", name="change_Pass")
     */
    public function change_PassAction(Request $req, ManagerRegistry $res, UserRepository $repo, $id, 
    UserPasswordHasherInterface $hasher): Response
    {   
        $user = $repo->find($id);
        $form = $this->createForm(UpdatePasswordType::class, $user);

        $form->handleRequest($req);
        $entity = $res->getManager();

       
        if($form->isSubmitted() && $form->isValid()){
            $user->setPassword($hasher->hashPassword($user, 
            $form->get('password')->getData()));

            $entity->persist($user);
            $entity->flush();

            return $this->json([
                'id' => $user->getId()
            ]);
        }

        return $this->render('profile/ChangePass.html.twig', [
            'form' => $form->createView()
        ]);
    }

    
}
