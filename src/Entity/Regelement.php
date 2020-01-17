<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegelementRepository")
 */
class Regelement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseurs", inversedBy="regelements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Fournissuer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ModeRegelement", inversedBy="regelements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modeRegelement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\Column(type="float")
     */
    private $montantRegelement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFournissuer(): ?Fournisseurs
    {
        return $this->Fournissuer;
    }

    public function setFournissuer(?Fournisseurs $Fournissuer): self
    {
        $this->Fournissuer = $Fournissuer;

        return $this;
    }

    public function getModeRegelement(): ?ModeRegelement
    {
        return $this->modeRegelement;
    }

    public function setModeRegelement(?ModeRegelement $modeRegelement): self
    {
        $this->modeRegelement = $modeRegelement;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getMontantRegelement(): ?float
    {
        return $this->montantRegelement;
    }

    public function setMontantRegelement(float $montantRegelement): self
    {
        $this->montantRegelement = $montantRegelement;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }
}
