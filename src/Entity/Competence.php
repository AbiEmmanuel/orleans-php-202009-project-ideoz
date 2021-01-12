<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
class Competence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $name;

    /**
     * @ORM\ManyToMany(targetEntity=Ecosystem::class, mappedBy="competence")
     */
    private Collection $companies;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class, mappedBy="competence")
     */
    private Collection $projects;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
        $this->projects = new ArrayCollection();
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
            $company->addCompetence($this);
        }

        return $this;
    }

    public function removeCompany(Ecosystem $company): self
    {
        if ($this->companies->removeElement($company)) {
            $company->removeCompetence($this);
        }

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->addCompetence($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            $project->removeCompetence($this);
        }

        return $this;
    }
}
