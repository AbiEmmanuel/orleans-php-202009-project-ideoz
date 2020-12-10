<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Testimonye;
use App\Entity\Ecosystem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TestimonyeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $testimonye = new Testimonye();
            $testimonye->setContent($faker->text);
            $testimonye->setEcosystem($this->getReference('ecosystem_' . $i));
            $manager->persist($testimonye);
            $this->addReference('testimonie_' . $i, $testimonye);
        }$manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            EcosystemeFixtures::class,
        ];
    }
}
