<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AchatsRepository")
 */
class Achats
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
<<<<<<< HEAD
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseurs", inversedBy="achats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Fournisseur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Date;
=======
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseurs", inversedBy="achats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $designation;
>>>>>>> 707bd74fc9b40f28444986a9bf33a9aff87cad36

    /**
     * @ORM\Column(type="float")
     */
    private $Montant;

    /**
<<<<<<< HEAD
     * @ORM\Column(type="boolean")
     */
    private $valide;
=======
     * @ORM\Column(type="string", length=255)
     */
    private $date;
>>>>>>> 707bd74fc9b40f28444986a9bf33a9aff87cad36

    public function getId(): ?int
    {
        return $this->id;
    }

<<<<<<< HEAD
    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getFournisseur(): ?Fournisseurs
    {
        return $this->Fournisseur;
    }

    public function setFournisseur(?Fournisseurs $Fournisseur): self
    {
        $this->Fournisseur = $Fournisseur;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->Date;
    }

    public function setDate(string $Date): self
    {
        $this->Date = $Date;
=======
    public function getDesignation(): ?Fournisseurs
    {
        return $this->designation;
    }

    public function setDesignation(?Fournisseurs $designation): self
    {
        $this->designation = $designation;
>>>>>>> 707bd74fc9b40f28444986a9bf33a9aff87cad36

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->Montant;
    }

    public function setMontant(float $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }

<<<<<<< HEAD
    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(bool $valide): self
    {
        $this->valide = $valide;
=======
    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;
>>>>>>> 707bd74fc9b40f28444986a9bf33a9aff87cad36

        return $this;
    }
}
