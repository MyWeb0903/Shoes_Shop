<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderDetailRepository::class)
 */
class OrderDetail
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
    private $Qty_Pro;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="OrderDetail_ID")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Order_ID;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="OrderDetail_ID")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQtyPro(): ?int
    {
        return $this->Qty_Pro;
    }

    public function setQtyPro(int $Qty_Pro): self
    {
        $this->Qty_Pro = $Qty_Pro;

        return $this;
    }

    public function getOrderID(): ?Order
    {
        return $this->Order_ID;
    }

    public function setOrderID(?Order $Order_ID): self
    {
        $this->Order_ID = $Order_ID;

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
