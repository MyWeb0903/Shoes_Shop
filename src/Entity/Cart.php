<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity=Contain::class, mappedBy="cart")
     */
    private $Contains;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->Contains = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection<int, Contain>
     */
    public function getContains(): Collection
    {
        return $this->Contains;
    }

    public function addContain(Contain $contain): self
    {
        if (!$this->Contains->contains($contain)) {
            $this->Contains[] = $contain;
            $contain->setCart($this);
        }

        return $this;
    }

    public function removeContain(Contain $contain): self
    {
        if ($this->Contains->removeElement($contain)) {
            // set the owning side to null (unless already changed)
            if ($contain->getCart() === $this) {
                $contain->setCart(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
