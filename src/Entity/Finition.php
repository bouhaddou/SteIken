<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FinitionRepository")
 */
class Finition
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
     * @ORM\OneToMany(targetEntity="App\Entity\FinitionDetails", mappedBy="Finitions")
     */
    private $finitionDetails;

    public function __construct()
    {
        $this->finitionDetails = new ArrayCollection();
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
     * @return Collection|FinitionDetails[]
     */
    public function getFinitionDetails(): Collection
    {
        return $this->finitionDetails;
    }

    public function addFinitionDetail(FinitionDetails $finitionDetail): self
    {
        if (!$this->finitionDetails->contains($finitionDetail)) {
            $this->finitionDetails[] = $finitionDetail;
            $finitionDetail->setFinitions($this);
        }

        return $this;
    }

    public function removeFinitionDetail(FinitionDetails $finitionDetail): self
    {
        if ($this->finitionDetails->contains($finitionDetail)) {
            $this->finitionDetails->removeElement($finitionDetail);
            // set the owning side to null (unless already changed)
            if ($finitionDetail->getFinitions() === $this) {
                $finitionDetail->setFinitions(null);
            }
        }

        return $this;
    }
}
