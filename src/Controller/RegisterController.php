<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
      /**
     * @Route("/register",name="register")
     */
    public function showsAction(Request $request, EntityManagerInterface $entityManager): Response
    {
      $user = new User();
      $form = $this->createForm(UserType::class, $user, [
        'action' => $this->generateUrl('register'),
        'method' => 'POST'
      ]);

      $form->handleRequest($request);
      
      $agreeTerms = $form->get('agreeTerms')->getData();

      if($form->isSubmitted() && $form->isValid() && $agreeTerms){
        

        $entityManager->persist($user);
        $entityManager->flush();
        return new Response('You have successfully created a user with id '.$user->getId());

      }

      return $this->render('register/index.html.twig', [
          'register_form' => $form->createView()    
      ]);
    } 
}
