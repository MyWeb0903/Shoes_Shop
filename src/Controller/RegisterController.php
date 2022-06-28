<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register",name="register")
     */
    public function registerAction(Request $request, EntityManagerInterface $entityManager,
      UserPasswordHasherInterface $hasher): Response
    {
      $user = new User();
      $form = $this->createForm(UserType::class, $user, [
        'action' => $this->generateUrl('register'),
        'method' => 'POST'
      ]);

      $form->handleRequest($request);
      
      $humanCheck = $form->get('humanCheck')->getData();

      if($form->isSubmitted() && $form->isValid() && $humanCheck){
        

        $user->setPassword($hasher->hashPassword($user, 
        $form->get('password')->getData()));

        $user->setRoles(['ROLE_USER']);

        $entityManager->persist($user);
        $entityManager->flush();
        return new Response('You have successfully created a user with id '.$user->getId());

      }

      return $this->render('register/index.html.twig', [
          'register_form' => $form->createView()    
      ]);
    } 
}
