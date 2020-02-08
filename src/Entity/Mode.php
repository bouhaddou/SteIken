<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModeRepository")
 */
class Mode
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
    private $modeReg;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AchatReg", mappedBy="Mode")
     */
    private $achatRegs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClientsVentes", mappedBy="Mode")
     */
    private $clientsVentes;

    public function __construct()
    {
        $this->achatRegs = new ArrayCollection();
        $this->clientsVentes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModeReg(): ?string
    {
        return $this->modeReg;
    }

    public function setModeReg(string $modeReg): self
    {
        $this->modeReg = $modeReg;

        return $this;
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
            $achatReg->setMode($this);
        }

        return $this;
    }

    public function removeAchatReg(AchatReg $achatReg): self
    {
        if ($this->achatRegs->contains($achatReg)) {
            $this->achatRegs->removeElement($achatReg);
            // set the owning side to null (unless already changed)
            if ($achatReg->getMode() === $this) {
                $achatReg->setMode(null);
            }
        }

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
            $clientsVente->setMode($this);
        }

        return $this;
    }

    public function removeClientsVente(ClientsVentes $clientsVente): self
    {
        if ($this->clientsVentes->contains($clientsVente)) {
            $this->clientsVentes->removeElement($clientsVente);
            // set the owning side to null (unless already changed)
            if ($clientsVente->getMode() === $this) {
                $clientsVente->setMode(null);
            }
        }

        return $this;
    }
}
