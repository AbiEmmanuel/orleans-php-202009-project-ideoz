<?php

namespace App\Entity;

use App\Repository\EcosystemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EcosystemRepository::class)
 */
class Ecosystem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $logo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $activity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $particularity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $url;

    /**
     * @ORM\OneToOne(targetEntity=Testimony::class, mappedBy="ecosystem", cascade={"persist", "remove"})
     */
    private Testimony $testimony;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private ?string $abstract;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="companies")
     */
    private ?Status $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getActivity(): ?string
    {
        return $this->activity;
    }

    public function setActivity(?string $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getParticularity(): ?string
    {
        return $this->particularity;
    }

    public function setParticularity(?string $particularity): self
    {
        $this->particularity = $particularity;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTestimony(): ?Testimony
    {
        return $this->testimony;
    }

    public function setTestimony(Testimony $testimony): self
    {
        $this->testimony = $testimony;

        // set the owning side of the relation if necessary
        if ($testimony->getEcosystem() !== $this) {
            $testimony->setEcosystem($this);
        }

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(?string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }
}
