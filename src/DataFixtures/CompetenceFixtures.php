<?php

namespace App\DataFixtures;

use App\Entity\Competence;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompetenceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $competence = new Competence();
            $competence->setName($faker->word);
            $competence->addCompany($this->getReference('ecosystem_' . rand(0, 19)));
            $competence->addProject($this->getReference('project_' . rand(0, 19)));
            $manager->persist($competence);
            $this->addReference('competence_' . $i, $competence);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [EcosystemeFixtures::class, ProjectFixtures::class];
    }
}
