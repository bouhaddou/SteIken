<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 * @UniqueEntity("designation")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min = 4, max = 100,
     *      minMessage = "La désignation ne doit pas inférieur à  {{ limit }} characters ",
     *      maxMessage = "La désignation ne doit pas supérieur à {{ limit }} characters")
     * 
     */
    private $designation;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $observation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Types", mappedBy="Categories")
     * @Assert\NotBlank
     */
    private $type;

    public function __construct()
    {
        $this->type = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * @return Collection|Types[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(Types $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
            $type->setCategories($this);
        }

        return $this;
    }

    public function removeType(Types $type): self
    {
        if ($this->type->contains($type)) {
            $this->type->removeElement($type);
            // set the owning side to null (unless already changed)
            if ($type->getCategories() === $this) {
                $type->setCategories(null);
            }
        }

        return $this;
    }
}
