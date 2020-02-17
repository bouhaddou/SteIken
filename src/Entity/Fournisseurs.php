<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FournisseursRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\OneToMany(targetEntity="App\Entity\AchatReg", mappedBy="fournisseur")
     */
    private $achatRegs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\PrePersist
     */
    public function PrePersist(){
        if(empty($this->date))
        {
            $this->date = new \DateTime();
        }
    }

    /**
     * Recupérer le total de debit
     * @return float
     */
    public function getSoldeFrs()
    {
        $sumDebit = array_reduce($this->achatRegs->toArray(),function($total,$achat){
            return $total + $achat->getDebit();
        },0);

        $sumCredit = array_reduce($this->achatRegs->toArray(),function($total,$achat){
            return $total + $achat->getCredit();
        },0);

      return $sumDebit - $sumCredit;
    }

    public function __construct()
    {
        $this->achatRegs = new ArrayCollection();
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

    public function setAdresse(?string $Adresse)
    {
        $this->Adresse = $Adresse;
    }
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return Collection|AchatReg[]
     */
    public function getAchatRegs(): Collection
    {
        return $this->achatRegs;
    }

    public function addAchatReg(AchatReg $achatReg): self
    {
        if (!$this->achatRegs->contains($achatReg)) {
            $this->achatRegs[] = $achatReg;
            $achatReg->setFournisseur($this);
        }

        return $this;
    }

    public function removeAchatReg(AchatReg $achatReg): self
    {
        if ($this->achatRegs->contains($achatReg)) {
            $this->achatRegs->removeElement($achatReg);
            // set the owning side to null (unless already changed)
            if ($achatReg->getFournisseur() === $this) {
                $achatReg->setFournisseur(null);
            }
        }

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



}