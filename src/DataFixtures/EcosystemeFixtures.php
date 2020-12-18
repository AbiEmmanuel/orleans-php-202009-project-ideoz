<?php

namespace App\DataFixtures;

use App\Entity\Ecosystem;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EcosystemeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $ecosystem = new Ecosystem();
            $ecosystem->setName($faker->company);
            $ecosystem->setLogo('https://via.placeholder.com/150');
            $ecosystem->setStatus($faker->boolean);
            $ecosystem->setActivity($faker->jobTitle);
            $ecosystem->setUrl($faker->url);
            $manager->persist($ecosystem);
            $this->addReference('ecosystem_' . $i, $ecosystem);
        }
        $manager->flush();
    }
}
