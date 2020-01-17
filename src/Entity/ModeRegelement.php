<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModeRegelementRepository")
 */
class ModeRegelement
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Regelement", mappedBy="modeRegelement")
     */
    private $regelements;

    public function __construct()
    {
        $this->regelements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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
            $regelement->setModeRegelement($this);
        }

        return $this;
    }

    public function removeRegelement(Regelement $regelement): self
    {
        if ($this->regelements->contains($regelement)) {
            $this->regelements->removeElement($regelement);
            // set the owning side to null (unless already changed)
            if ($regelement->getModeRegelement() === $this) {
                $regelement->setModeRegelement(null);
            }
        }

        return $this;
    }
}
