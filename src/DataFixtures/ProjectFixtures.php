<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $project = new Project();
            $project->setTitle($faker->sentence());
            $project->setPurpose($faker->sentence);
            $project->setPresentation($faker->text(500));
            $project->setOwner($this->getReference('ecosystem_' . rand(0, 49)));
            $manager->persist($project);
            $this->addReference('project_' . $i, $project);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [EcosystemeFixtures::class];
    }
}
