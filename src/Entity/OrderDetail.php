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
}
