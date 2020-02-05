<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Roles", inversedBy="users")
     */
    private $UserRoles;

    public function __construct()
    {
        $this->UserRoles = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Roles[]
     */
    public function getUserRoles(): Collection
    {
        return $this->UserRoles;
    }

    public function addUserRole(Roles $userRole): self
    {
        if (!$this->UserRoles->contains($userRole)) {
            $this->UserRoles[] = $userRole;
        }

        return $this;
    }

    public function removeUserRole(Roles $userRole): self
    {
        if ($this->UserRoles->contains($userRole)) {
            $this->UserRoles->removeElement($userRole);
        }

        return $this;
    }

 
    public function getUsername()
    {
        return $this->email;
    }

    public function getRoles()
    {
        $roles = $this->UserRoles->map(function($role){
            return $role->getLibelle();
        })->toArray();

        $roles [] = 'ROLE_USER';
        return $roles;
    }

    public function getSalt()
    { 

    }

    public function eraseCredentials()
    {

     }
 
}
