<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientsParRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ClientsPar
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
    private $NomComplet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClientsVentes", mappedBy="clients")
     */
    private $clientsVentes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClientsVentes", mappedBy="clientsPar")
     */
    private $clientsVents;

    public function __construct()
    {
        $this->clientsVentes = new ArrayCollection();
        $this->clientsVents = new ArrayCollection();
    }
    /**
     * @ORM\PrePersist
     */
    public function PrePersist(){
        if(empty($this->date))
        {
            $this->date = new \DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComplet(): ?string
    {
        return $this->NomComplet;
    }

    public function setNomComplet(string $NomComplet): self
    {
        $this->NomComplet = $NomComplet;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate( $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|ClientsVentes[]
     */
    public function getClientsVentes(): Collection
    {
        return $this->clientsVentes;
    }

    public function addClientsVente(ClientsVentes $clientsVente): self
    {
        if (!$this->clientsVentes->contains($clientsVente)) {
            $this->clientsVentes[] = $clientsVente;
            $clientsVente->setClients($this);
        }

        return $this;
    }

    public function removeClientsVente(ClientsVentes $clientsVente): self
    {
        if ($this->clientsVentes->contains($clientsVente)) {
            $this->clientsVentes->removeElement($clientsVente);
            // set the owning side to null (unless already changed)
            if ($clientsVente->getClients() === $this) {
                $clientsVente->setClients(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ClientsVentes[]
     */
    public function getClientsVents(): Collection
    {
        return $this->clientsVents;
    }

    public function addClientsVent(ClientsVentes $clientsVent): self
    {
        if (!$this->clientsVents->contains($clientsVent)) {
            $this->clientsVents[] = $clientsVent;
            $clientsVent->setClientsPar($this);
        }

        return $this;
    }

    public function removeClientsVent(ClientsVentes $clientsVent): self
    {
        if ($this->clientsVents->contains($clientsVent)) {
            $this->clientsVents->removeElement($clientsVent);
            // set the owning side to null (unless already changed)
            if ($clientsVent->getClientsPar() === $this) {
                $clientsVent->setClientsPar(null);
            }
        }

        return $this;
    }
}
