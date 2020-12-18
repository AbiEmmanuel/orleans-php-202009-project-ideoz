<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Testimony;
use App\Entity\Ecosystem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TestimonyFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $testimony = new Testimony();
            $testimony->setContent($faker->text);
            $testimony->setEcosystem($this->getReference('ecosystem_' . $i));
            $manager->persist($testimony);
            $this->addReference('testimony_' . $i, $testimony);
        }
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            EcosystemeFixtures::class,
        ];
    }
}
