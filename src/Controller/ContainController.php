<?php

namespace App\Controller;

use App\Entity\Contain;
use App\Form\Type\UpdateCartType;
use App\Repository\CartRepository;
use App\Repository\ContainRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainController extends AbstractController
{
    /**
     * @Route("/contain/{id}", name="cart_page")
     */
    public function addCartAction(ProductRepository $repo, $id, ManagerRegistry $res,
        CartRepository $cartRepo, ContainRepository $contRepo): Response
    {

        $entity = $res->getManager();
        $contain = new Contain();

        $user = $this->getUser();

        $cart = $cartRepo->findOneBy(['user'=>$user]);//cart

        $product = $repo->find($id);
        
        $cont = $contRepo->checkQty($id, $cart);

        if($cont[0]['count'] == 0){
            $contain->setCart($cart);
            $contain->setProduct($product);
            $contain->setQtyProduct(1);
    
            $entity->persist($contain);
            $entity->flush();
    
        }
        else{

            $quantity = $cont[0]['quantity'] + 1;

            $containID = $cont[0]['id'];
            $contain = $contRepo->find($containID);
            
            $contain->setQtyProduct($quantity);

            $entity->persist($contain);
            $entity->flush();
        }


        return $this->redirectToRoute('product_page');
    }

    
    /**
     * @Route("/deleteContain/{id}", name="delete_cart")
     */
    public function deleteCartAction($id, ContainRepository $repo, ManagerRegistry $res): Response
    {
        $entity = $res->getManager();
        $contain = $repo->find($id);

        $entity->remove($contain);
        $entity->flush();

        return $this->redirectToRoute('showcart');
    }


    /**
     * @Route("/updateContain/{id}", name="update_cart")
     */
    public function FunctionName(Request $req, $id, ContainRepository $repo, ManagerRegistry $res): Response
    {
        $entity = $res->getManager();
        $contain = $repo->find($id);
        $form = $this->createForm(UpdateCartType::class, $contain);

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid()){
            $contain->setQtyProduct($form->get('Qty_Product')->getData());

            $entity->persist($contain);
            $entity->flush();

            return $this->redirectToRoute('showcart');
        } 
        
        return $this->render('contain/UpdateCart.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/sum", name="sum")
     */
    public function sumAction(ContainRepository $rep, CartRepository $cartRe): Response
    {   
        $user = $this->getUser();
        $cart = $cartRe->findOneBy(['user'=>$user]);
        $a = $rep->sumquantityPro($cart);
        $n = $a[0]['sumPrice'];
        return $this->json($n);
    }
}
