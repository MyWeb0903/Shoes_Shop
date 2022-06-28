<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Fullname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Address;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $Phone;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $Gender;

    /**
     * @ORM\Column(type="date")
     */
    private $Birthday;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="user")
     */
    private $Order_ID;

    /**
     * @ORM\OneToMany(targetEntity=Cart::class, mappedBy="user")
     */
    private $Cart_ID;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="users")
     */
    private $Product_ID;

    public function __construct()
    {
        $this->Order_ID = new ArrayCollection();
        $this->Cart_ID = new ArrayCollection();
        $this->Product_ID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFullname(): ?string
    {
        return $this->Fullname;
    }

    public function setFullname(string $Fullname): self
    {
        $this->Fullname = $Fullname;

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

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

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

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(string $Gender): self
    {
        $this->Gender = $Gender;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->Birthday;
    }

    public function setBirthday(\DateTimeInterface $Birthday): self
    {
        $this->Birthday = $Birthday;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrderID(): Collection
    {
        return $this->Order_ID;
    }

    public function addOrderID(Order $orderID): self
    {
        if (!$this->Order_ID->contains($orderID)) {
            $this->Order_ID[] = $orderID;
            $orderID->setUser($this);
        }

        return $this;
    }

    public function removeOrderID(Order $orderID): self
    {
        if ($this->Order_ID->removeElement($orderID)) {
            // set the owning side to null (unless already changed)
            if ($orderID->getUser() === $this) {
                $orderID->setUser(null);
            }
        }

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
            $cartID->setUser($this);
        }

        return $this;
    }

    public function removeCartID(Cart $cartID): self
    {
        if ($this->Cart_ID->removeElement($cartID)) {
            // set the owning side to null (unless already changed)
            if ($cartID->getUser() === $this) {
                $cartID->setUser(null);
            }
        }

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
        }

        return $this;
    }

    public function removeProductID(Product $productID): self
    {
        $this->Product_ID->removeElement($productID);

        return $this;
    }
}
