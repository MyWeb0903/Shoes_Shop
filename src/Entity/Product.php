<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
    private $Image;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $Price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Detail;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetail::class, mappedBy="product")
     */
    private $OrderDetail_ID;

    /**
     * @ORM\ManyToOne(targetEntity=Supplier::class, inversedBy="Product_ID")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Supplier_ID;

    /**
     * @ORM\ManyToMany(targetEntity=Cart::class, inversedBy="products")
     */
    private $Cart_ID;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="Product_ID")
     */
    private $users;

    public function __construct()
    {
        $this->OrderDetail_ID = new ArrayCollection();
        $this->Cart_ID = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->Detail;
    }

    public function setDetail(string $Detail): self
    {
        $this->Detail = $Detail;

        return $this;
    }

    /**
     * @return Collection<int, OrderDetail>
     */
    public function getOrderDetailID(): Collection
    {
        return $this->OrderDetail_ID;
    }

    public function addOrderDetailID(OrderDetail $orderDetailID): self
    {
        if (!$this->OrderDetail_ID->contains($orderDetailID)) {
            $this->OrderDetail_ID[] = $orderDetailID;
            $orderDetailID->setProduct($this);
        }

        return $this;
    }

    public function removeOrderDetailID(OrderDetail $orderDetailID): self
    {
        if ($this->OrderDetail_ID->removeElement($orderDetailID)) {
            // set the owning side to null (unless already changed)
            if ($orderDetailID->getProduct() === $this) {
                $orderDetailID->setProduct(null);
            }
        }

        return $this;
    }

    public function getSupplierID(): ?Supplier
    {
        return $this->Supplier_ID;
    }

    public function setSupplierID(?Supplier $Supplier_ID): self
    {
        $this->Supplier_ID = $Supplier_ID;

        return $this;
    }

    /**
     * @return Collection<int, Cart>
     */
    public function getCartID(): Collection
    {
        return $this->Cart_ID;
    }

    public function addCartID(Cart $cartID): self
    {
        if (!$this->Cart_ID->contains($cartID)) {
            $this->Cart_ID[] = $cartID;
        }

        return $this;
    }

    public function removeCartID(Cart $cartID): self
    {
        $this->Cart_ID->removeElement($cartID);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addProductID($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeProductID($this);
        }

        return $this;
    }
}
