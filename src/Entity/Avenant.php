<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvenantRepository")
 */
class Avenant
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
    private $Libelle;

    /**
     * @ORM\Column(type="float")
     */
    private $MontantAvenant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clients", inversedBy="avenants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getMontantAvenant(): ?float
    {
        return $this->MontantAvenant;
    }

    public function setMontantAvenant(float $MontantAvenant): self
    {
        $this->MontantAvenant = $MontantAvenant;

        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->Client;
    }

    public function setClient(?Clients $Client): self
    {
        $this->Client = $Client;

        return $this;
    }
}
