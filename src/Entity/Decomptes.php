<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DecomptesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Decomptes
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
    private $MontantDecompte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clients", inversedBy="decomptes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Client;

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

    public function getMontantDecompte(): ?float
    {
        return $this->MontantDecompte;
    }

    public function setMontantDecompte(float $MontantDecompte): self
    {
        $this->MontantDecompte = $MontantDecompte;

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
