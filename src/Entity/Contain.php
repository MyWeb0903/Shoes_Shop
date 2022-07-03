<?php

namespace App\Entity;

use App\Repository\ContainRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContainRepository::class)
 */
class Contain
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Qty_Product;

    /**
     * @ORM\ManyToOne(targetEntity=Cart::class, inversedBy="Contains")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cart;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="Contains")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQtyProduct(): ?int
    {
        return $this->Qty_Product;
    }

    public function setQtyProduct(int $Qty_Product): self
    {
        $this->Qty_Product = $Qty_Product;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
