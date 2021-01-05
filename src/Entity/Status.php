<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusRepository::class)
 */
class Status
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private ?string $name;

    /**
     * @ORM\OneToMany(targetEntity=Ecosystem::class, mappedBy="status")
     */
    private Collection $companies;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
    }

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

    /**
     * @return Collection|Ecosystem[]
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Ecosystem $company): self
    {
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
            $company->setStatus($this);
        }

        return $this;
    }

    public function removeCompany(Ecosystem $company): self
    {
        if ($this->companies->removeElement($company)) {
            // set the owning side to null (unless already changed)
            if ($company->getStatus() === $this) {
                $company->setStatus(null);
            }
        }

        return $this;
    }
}
