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
     * @ORM\Column(type="boolean")
     */
    private bool $clientOrPartner;

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
     * @ORM\OneToOne(targetEntity=Testimonye::class, mappedBy="ecosystem", cascade={"persist", "remove"})
     */
    private Testimonye $testimonye;

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

    public function getClientOrPartner(): ?bool
    {
        return $this->clientOrPartner;
    }

    public function setClientOrPartner(bool $clientOrPartner): self
    {
        $this->clientOrPartner = $clientOrPartner;

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

    public function getTestimonye(): ?Testimonye
    {
        return $this->testimonye;
    }

    public function setTestimonye(Testimonye $testimonye): self
    {
        $this->testimonye = $testimonye;

        // set the owning side of the relation if necessary
        if ($testimonye->getEcosystem() !== $this) {
            $testimonye->setEcosystem($this);
        }

        return $this;
    }
}
