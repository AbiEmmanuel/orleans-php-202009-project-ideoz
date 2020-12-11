<?php

namespace App\Entity;

use App\Repository\TestimonyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestimonyRepository::class)
 */
class Testimony
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
     * @ORM\OneToOne(targetEntity=Ecosystem::class, inversedBy="testimony", cascade={"persist", "remove"})
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
