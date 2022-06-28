<?php

namespace App\Entity;

use App\Repository\SupplierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SupplierRepository::class)
 */
class Supplier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="Supplier_ID")
     */
    private $Product_ID;

    public function __construct()
    {
        $this->Product_ID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProductID(): Collection
    {
        return $this->Product_ID;
    }

    public function addProductID(Product $productID): self
    {
        if (!$this->Product_ID->contains($productID)) {
            $this->Product_ID[] = $productID;
            $productID->setSupplierID($this);
        }

        return $this;
    }

    public function removeProductID(Product $productID): self
    {
        if ($this->Product_ID->removeElement($productID)) {
            // set the owning side to null (unless already changed)
            if ($productID->getSupplierID() === $this) {
                $productID->setSupplierID(null);
            }
        }

        return $this;
    }
}
