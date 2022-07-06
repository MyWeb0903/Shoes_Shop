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

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product_page")
     */
    public function productAction(ProductRepository $repo): Response
    {
        $product = $repo->findAll();
        
     
        return $this->render('product/index.html.twig', [
            'products' => $product
        ]);
    }


    /**
     * @Route("/addProduct", name="add_Product")
     */
    public function addProductAction(ManagerRegistry $res, Request $req): Response
    {
        $product = new Product();
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
            $product->setImage($imageFile);
            $product->setSupplierID($data->getSupplierID());

            $entity->persist($product);
            $entity->flush();

            return $this->redirectToRoute('pro_manager');
        }

        return $this->render('product/addProduct.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
