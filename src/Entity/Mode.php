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

    public function __construct()
    {
        $this->achatRegs = new ArrayCollection();
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
}
