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
     * @Route("/register",name="app_signup")
     */
    public function showsAction(Request $request, EntityManagerInterface $entityManager,
    UserPasswordHasherInterface $hasher): Response
    {
      $user = new User();
      $form = $this->createForm(UserType::class, $user, [
        'action' => $this->generateUrl('app_signup'),
        'method' => 'POST'
      ]);

      $form->handleRequest($request);
      
      $humanCheck = $form->get('humanCheck')->getData();

      if($form->isSubmitted() && $form->isValid() && $humanCheck){
        
        // $user->setPassword($hasher->hashPassword($user, $form->get('password')->getData()));
        
        $user->setPassword($hasher->hashPassword($user, 
        $form->get('password')->getData()));

        $user->setRoles(['ROLE_USER']);

        $entityManager->persist($user);
        $entityManager->flush();
        
        // return new Response('You have successfully created a user with id '.$user->getId());
        // $cart->setUser($user);
        // $entityManager->persist($cart);
        $entityManager->flush();
        return $this->redirectToRoute('app_login');

      }

      return $this->render('register/index.html.twig', [
          'register_form' => $form->createView()    
      ]);
    } 


    /**
     * @Route("/registerAdmin",name="add_admin")
     */
    public function addAdminAction(Request $request, EntityManagerInterface $entityManager,
      UserPasswordHasherInterface $hasher): Response
    {
      $user = new User();
      $form = $this->createForm(UserType::class, $user, [
        'action' => $this->generateUrl('add_admin'),
        'method' => 'POST'
      ]);

      $form->handleRequest($request);
      
      $humanCheck = $form->get('humanCheck')->getData();

      if($form->isSubmitted() && $form->isValid() && $humanCheck){
        

        $user->setPassword($hasher->hashPassword($user, 
        $form->get('password')->getData()));

        $user->setRoles(['ROLE_ADMIN']);

        $entityManager->persist($user);
        $entityManager->flush();
        return $this->redirectToRoute('user_manager');

      }

      return $this->render('register/index.html.twig', [
          'register_form' => $form->createView()    
      ]);
    }
}


