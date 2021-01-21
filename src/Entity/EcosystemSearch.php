<?php


namespace App\Entity;


use Doctrine\Common\Collections\Collection;

class EcosystemSearch
{
    private ?string $input = '';

    private ?Collection $competences = null;

    /**
     * @return string|null
     */
    public function getInput(): ?string
    {
        return $this->input;
    }

    /**
     * @param string|null $input
     */
    public function setInput(?string $input): void
    {
        $this->input = $input;
    }

    /**
     * @return Collection|null
     */
    public function getCompetences(): ?Collection
    {
        return $this->competences;
    }

    /**
     * @param Collection|null $competences
     */
    public function setCompetences(?Collection $competences): void
    {

        $this->competences = $competences;
    }

}