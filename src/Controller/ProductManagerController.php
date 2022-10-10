<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\Type\ProductType;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductManagerController extends AbstractController
{
    /**
     * @Route("/promanager", name="pro_manager")
     */
    public function pro_managerAction(ProductRepository $repo): Response
    {
        $product = $repo->findAll();
        return $this->render('ProductManager/index.html.twig', [
            'product' => $product
        ]);
    }


    /**
    * @Route("/editProduct/{id}", name="editProduct")
    */
    public function editAnimalAction(Request $req, ManagerRegistry $res, ProductRepository $repo, $id): Response
    {
        $product = $repo->find($id);
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($req);
        $entity = $res->getManager();

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $imageFile = $form->get('Image')->getData()->getClientOriginalName();
            $product->setName($data->getName());
            $product->setQuantity($data->getQuantity());
            $product->setPrice($data->getPrice());
            $product->setDetail($data->getDetail());
            // $product->setImage($data->getImage());
            $product->setImage($imageFile);
            $product->setSupplierID($data->getSupplierID());

            $entity->persist($product);
            $entity->flush();

            return $this->redirectToRoute('pro_manager');
        }

        return $this->render("product/editProduct.html.twig",[
            'form' => $form->createView()
        ]);
    }



    /**
    * @Route("/deleteProduct/{id}", name="deleteProduct")
    */
    public function deleteAction(ManagerRegistry $res, Request $req, ProductRepository $repo, $id): Response
    {
        $entity = $res->getManager();
        $product = $repo->find($id);
        if(!$product){
            return $this->json("No project found");
        }

        $entity->remove($product);
        $entity->flush();

        return $this->redirectToRoute('pro_manager');
    }

}