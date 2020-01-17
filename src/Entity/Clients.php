<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Clients
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
    private $NomComplete;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TypeClient;

    /**
     * @ORM\Column(type="float")
     */
    private $RevesionPrix;

    /**
     * @ORM\Column(type="float")
     */
    private $penalite;

    /**
     * @ORM\Column(type="float")
     */
    private $retenueGrantie;

    /**
     * @ORM\Column(type="float")
     */
    private $retenueFinition;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="float")
     */
    private $MontantTravaux;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Decomptes", mappedBy="Client")
     */
    private $decomptes;

    /**
     * @ORM\Column(type="float")
     */
    private $Prorata;

 

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Avenant", mappedBy="Client")
     */
    private $avenants;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $objet;

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if(empty($this->RevesionPrix)){ $this->RevesionPrix = 0 ; }
        if(empty($this->MontantTravaux)){ $this->MontantTravaux = 0 ; }
        if(empty($this->penalite)){ $this->penalite = 0 ; }
        if(empty($this->retenueGrantie)){ $this->retenueGrantie = 0 ; }
        if(empty($this->retenueFinition)){ $this->retenueFinition = 0 ; }
        if(empty($this->Prorata)){ $this->Prorata = 0 ; }
      
    }
    public function getTotalDecomptes()
    {
        $sum = array_reduce($this->decomptes->toArray(), function ($total, $decompte) {
            return $total + $decompte->getMontantDecompte();
        }, 0);
        return $sum;
    }
    public function getTotalAvenant()
    {
        $sumAv = array_reduce($this->avenants->toArray(), function ($total, $avenant) {
            return $total + $avenant->getMontantAvenant();
        }, 0);
        return $sumAv;
    }
    public function CalcMontantTotal(){
        $total = 0 ;
        $total = 
            $this->MontantTravaux + $this->getTotalAvenant() + $this->RevesionPrix - 
            $this->penalite - $this->retenueGrantie -$this->retenueFinition - $this->Prorata - $this->getTotalDecomptes();
        return  $total;
    }

    public function CalcRestAPaye(){
        $RestAPaye = 0 ;
        $RestAPaye = $this->CalcMontantTotal() + $this->retenueGrantie + $this->retenueFinition;
        return  $RestAPaye;
    }

    public function __construct()
    {
        $this->decomptes = new ArrayCollection();
        $this->avenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComplete(): ?string
    {
        return $this->NomComplete;
    }

    public function setNomComplete(string $NomComplete): self
    {
        $this->NomComplete = $NomComplete;

        return $this;
    }

    public function getTypeClient(): ?string
    {
        return $this->TypeClient;
    }

    public function setTypeClient(string $TypeClient): self
    {
        $this->TypeClient = $TypeClient;

        return $this;
    }

    public function getRevesionPrix(): ?float
    {
        return $this->RevesionPrix;
    }

    public function setRevesionPrix(float $RevesionPrix): self
    {
        $this->RevesionPrix = $RevesionPrix;

        return $this;
    }

    public function getPenalite(): ?float
    {
        return $this->penalite;
    }

    public function setPenalite(float $penalite): self
    {
        $this->penalite = $penalite;

        return $this;
    }

    public function getRetenueGrantie(): ?float
    {
        return $this->retenueGrantie;
    }

    public function setRetenueGrantie(float $retenueGrantie): self
    {
        $this->retenueGrantie = $retenueGrantie;

        return $this;
    }

    public function getRetenueFinition(): ?float
    {
        return $this->retenueFinition;
    }

    public function setRetenueFinition(float $retenueFinition): self
    {
        $this->retenueFinition = $retenueFinition;

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

    public function getMontantTravaux(): ?float
    {
        return $this->MontantTravaux;
    }

    public function setMontantTravaux(float $MontantTravaux): self
    {
        $this->MontantTravaux = $MontantTravaux;

        return $this;
    }


    /**
     * @return Collection|Decomptes[]
     */
    public function getDecomptes(): Collection
    {
        return $this->decomptes;
    }

    public function addDecompte(Decomptes $decompte): self
    {
        if (!$this->decomptes->contains($decompte)) {
            $this->decomptes[] = $decompte;
            $decompte->setClient($this);
        }

        return $this;
    }

    public function removeDecompte(Decomptes $decompte): self
    {
        if ($this->decomptes->contains($decompte)) {
            $this->decomptes->removeElement($decompte);
            // set the owning side to null (unless already changed)
            if ($decompte->getClient() === $this) {
                $decompte->setClient(null);
            }
        }

        return $this;
    }

    public function getProrata(): ?float
    {
        return $this->Prorata;
    }

    public function setProrata(float $Prorata): self
    {
        $this->Prorata = $Prorata;

        return $this;
    }



    /**
     * @return Collection|Avenant[]
     */
    public function getAvenants(): Collection
    {
        return $this->avenants;
    }

    public function addAvenant(Avenant $avenant): self
    {
        if (!$this->avenants->contains($avenant)) {
            $this->avenants[] = $avenant;
            $avenant->setClient($this);
        }

        return $this;
    }

    public function removeAvenant(Avenant $avenant): self
    {
        if ($this->avenants->contains($avenant)) {
            $this->avenants->removeElement($avenant);
            // set the owning side to null (unless already changed)
            if ($avenant->getClient() === $this) {
                $avenant->setClient(null);
            }
        }

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(?string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }
}
