<?php

namespace App\Entity;

use App\Repository\TestimonyeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestimonyeRepository::class)
 */
class Testimonye
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="text")
     */
    private string $content;

    /**
     * @ORM\OneToOne(targetEntity=Ecosystem::class, inversedBy="testimonye", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private Ecosystem $ecosystem;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getEcosystem(): ?Ecosystem
    {
        return $this->ecosystem;
    }

    public function setEcosystem(Ecosystem $ecosystem): self
    {
        $this->ecosystem = $ecosystem;

        return $this;
    }
}
