<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
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
    private $Quantity_Pro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantityPro(): ?int
    {
        return $this->Quantity_Pro;
    }

    public function setQuantityPro(int $Quantity_Pro): self
    {
        $this->Quantity_Pro = $Quantity_Pro;

        return $this;
    }
}
