<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FournisseursRepository")
 */
class Fournisseurs
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
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Achats", mappedBy="Fournisseur")
     */
    private $achats;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Regelement", mappedBy="Fournissuer")
     */
    private $regelements;

    
    public function __construct()
    {
        $this->achats = new ArrayCollection();
        $this->regelements = new ArrayCollection();

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

    public function setEmail(string $Email): self
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
    }
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;
    }
    /**
     * @return Collection|Achats[]
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achats $achat): self
    {
        if (!$this->achats->contains($achat)) {
            $this->achats[] = $achat;
            $achat->setFournisseur($this);
            $achat->setDesignation($this);
        }

        return $this;
    }

    public function removeAchat(Achats $achat): self
    {
        if ($this->achats->contains($achat)) 
        {
            $this->achats->removeElement($achat);
            // set the owning side to null (unless already changed)
            if ($achat->getFournisseur() === $this) {
                $achat->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Regelement[]
     */
    public function getRegelements(): Collection
    {
        return $this->regelements;
    }

    public function addRegelement(Regelement $regelement): self
    {
        if (!$this->regelements->contains($regelement)) {
            $this->regelements[] = $regelement;
            $regelement->setFournissuer($this);
        }

        return $this;
    }

    public function removeRegelement(Regelement $regelement): self
    {
        if ($this->regelements->contains($regelement)) {
            $this->regelements->removeElement($regelement);
            // set the owning side to null (unless already changed)
            if ($regelement->getFournissuer() === $this) {
                $regelement->setFournissuer(null);
            if ($achat->getDesignation() === $this) {
                $achat->setDesignation(null);
            }
        }

        return $this;
    }
}
}