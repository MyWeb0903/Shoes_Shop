<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\Type\ProductType;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintValidatorInterface;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product_page")
     */
    public function productAction(ProductRepository $repo): Response
    {
        // $product = $repo->findAll();
        
        return $this->render('product/index.html.twig', [
            'product' => $repo
        ]);
    }

    /**
     * @Route("/product/{id}", name="detail_page")
     */
    public function detailAction(ProductRepository $repo, $id): Response
    {
        $product = $repo->find($id);
        return $this->render('product/detail.html.twig', [
            'p' => $product
        ]);
    }

    /**
     * @Route("/addProduct", name="addProduct")
     */
    public function addProductAction(ManagerRegistry $res, Request $req): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($req);
        $entity = $res->getManager();

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $file = $form->get('Image')->getData()->getClientOriginalName();
            $product->setName($data->getName());
            $product->setQuantity($data->getQuantity());
            $product->setPrice($data->getPrice());
            $product->setDetail($data->getDetail());
            $product->setImage($data->getImage());
            $product->setSupplierID($data->getSupplierID());

            $entity->persist($product);
            $entity->flush();

            return $this->json([
                'id' => $product->getId()
            ]);
        }

        return $this->render('product/addProduct.html.twig', [
            'form' => $form->createView()
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
            $product->setName($data->getName());
            $product->setQuantity($data->getQuantity());
            $product->setPrice($data->getPrice());
            $product->setDetail($data->getDetail());
            $product->setImage($data->getImage());
            $product->setSupplierID($data->getSupplierID());

            $entity->persist($product);
            $entity->flush();

            return $this->json([
                'id' => $product->getId()
            ]);
        }

        return $this->render("product/.html.twig",[
            'form' => $form->createView()
        ]);
    }



    /**
    * @Route("/deleteProduct/{id}", name="deleteProduct", methods={"DELETE"})
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

        return $this->json("Delete a project successfully with id". $id);
    }
}
