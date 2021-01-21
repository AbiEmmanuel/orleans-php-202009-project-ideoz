<?php

namespace App\DataFixtures;

use App\Entity\Ecosystem;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EcosystemeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $ecosystem = new Ecosystem();
            $ecosystem->setName($faker->company);
            $image = 'https://loremflickr.com/320/240/';
            $imageName = uniqid() . '.jpg';
            copy($image, __DIR__ . '/../../public/uploads/logos/' . $imageName);
            $ecosystem->setLogo($imageName);
            $ecosystem->setStatus($this->getReference('status_' . rand(0, 3)));
            $ecosystem->setActivity($faker->jobTitle);
            $ecosystem->setUrl($faker->url);
            $ecosystem->setAbstract($faker->text());
            $ecosystem->setPresentation($faker->text(600));
            $ecosystem->setIsValidated(rand(0, 1));
            $manager->persist($ecosystem);
            $this->addReference('ecosystem_' . $i, $ecosystem);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [StatusFixtures::class];
    }
}
