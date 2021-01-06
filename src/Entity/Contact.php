<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\NotBlank
     * @Assert\Length(max="255")
     */
    private string $name;

    /**
     * @Assert\NotBlank
     * @Assert\Length(max="255")
     */
    private string $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(max="255")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Seuls les caractères numériques sont autorisés.")
     */
    private string $phone;

    /**
     * @Assert\NotBlank
     */
    private string $subject;

    /**
     * @Assert\NotBlank
     */
    private string $message;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
