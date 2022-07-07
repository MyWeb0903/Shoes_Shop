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
    public function profileAction(UserRepository $repo): Response
    {
        $user = $this->getUser();
        // $user = $get;
        $profiles = $repo->getUserAccount($user);
        return $this->render('profile/indedemo.html.twig', [
            'profiles' => $profiles
        ]);
    }


    /**
     * @Route("/updateProfile", name="update_profile", methods={"POST"})
     */
    public function UpdateProfileAction(UserRepository $repo, Request $req, ManagerRegistry $res): Response
    {
        $entity = $res->getManager();
        $user = $this->getUser();
        $findUser = $repo->find($user);

        $fullname = $req->request->get('txt-fullname');
        $email = $req->request->get('txt-email');
        $address = $req->request->get('txt-address');
        $gender = $req->request->get('sele-gender');
        $phone = $req->request->get('txt-phone');

        $findUser->setFullname($fullname);
        $findUser->setEmail($email);
        $findUser->setAddress($address);
        $findUser->setGender($gender);
        $findUser->setPhone($phone);


        $entity->persist($findUser);
        $entity->flush();
        return $this->redirectToRoute('profile_page');
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
    public function passwordOldAction(Request $req, UserPasswordHasherInterface $hasher, UserRepository $repo): Response
    {
        $user = $this->getUser();
        $oldPass = $req->request->get('oldpass-txt');

        $k = $repo->getpass($user);
        $pass = $k[0]['Pass'];

        $get = $hasher->isPasswordValid($user, $oldPass);

        if ($get == $pass) {
            return $this->redirectToRoute('change_Pass');
        } else {
            return $this->redirectToRoute('error_change_pass');
        }
    }


    /**
     * @Route("/changePass", name="change_Pass")
     */
    public function change_PassAction(
        Request $req,
        ManagerRegistry $res,
        UserRepository $repo,
        UserPasswordHasherInterface $hasher,
        CartRepository $cRepo
    ): Response {
        $user = $this->getUser();
        $cart = $cRepo->findOneBy(['user' => $user]);
        $n = $cRepo->getUserID($cart);

        $k = $n[0]['ID'];

        $user = $repo->find($k);
        $form = $this->createForm(UpdatePasswordType::class, $user);



        $form->handleRequest($req);
        $entity = $res->getManager();


        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($hasher->hashPassword(
                $user,
                $form->get('password')->getData()
            ));

            $entity->persist($user);
            $entity->flush();

            return $this->redirectToRoute('profile_page');
        }

        return $this->render('profile/ChangePass.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
