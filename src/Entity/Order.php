<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $OrderDate;

    /**
     * @ORM\Column(type="date")
     */
    private $DeliveryDate;

    /**
     * @ORM\Column(type="float")
     */
    private $Payment;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Status;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $Phone;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Order_ID")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetail::class, mappedBy="Order_ID")
     */
    private $OrderDetail_ID;

    public function __construct()
    {
        $this->OrderDetail_ID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->OrderDate;
    }

    public function setOrderDate(\DateTimeInterface $OrderDate): self
    {
        $this->OrderDate = $OrderDate;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->DeliveryDate;
    }

    public function setDeliveryDate(\DateTimeInterface $DeliveryDate): self
    {
        $this->DeliveryDate = $DeliveryDate;

        return $this;
    }

    public function getPayment(): ?float
    {
        return $this->Payment;
    }

    public function setPayment(float $Payment): self
    {
        $this->Payment = $Payment;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $orderDetailID->setOrderID($this);
        }

        return $this;
    }

    public function removeOrderDetailID(OrderDetail $orderDetailID): self
    {
        if ($this->OrderDetail_ID->removeElement($orderDetailID)) {
            // set the owning side to null (unless already changed)
            if ($orderDetailID->getOrderID() === $this) {
                $orderDetailID->setOrderID(null);
            }
        }

        return $this;
    }
}
