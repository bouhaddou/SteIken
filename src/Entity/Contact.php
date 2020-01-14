<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
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
     *      minMessage = "Le Nom  ne doit pas inférieur à  {{ limit }} characters ",
     *      maxMessage = "Le Nom ne doit pas supérieur à {{ limit }} characters"
     * )
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min = 4, max = 50,
     *      minMessage = "L'objet   ne doit pas inférieur à  {{ limit }} characters ",
     *      maxMessage = "L'objet   ne doit pas supérieur à {{ limit }} characters"
     * )
     */
    private $Subject;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Phone;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min = 10,
     *      minMessage = "Le Nom  ne doit pas inférieur à  {{ limit }} characters "
     * )
     */
    private $Message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->Subject;
    }

    public function setSubject(string $Subject): self
    {
        $this->Subject = $Subject;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(?string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->Message;
    }

    public function setMessage(string $Message): self
    {
        $this->Message = $Message;

        return $this;
    }
}
