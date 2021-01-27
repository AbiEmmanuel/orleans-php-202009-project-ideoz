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
        for ($i = 0; $i < 30; $i++) {
            $ecosystem = new Ecosystem();
            $ecosystem->setName($faker->company);
            $image = 'https://loremflickr.com/200/200/';
            $imageName = uniqid() . '.jpg';
            copy($image, __DIR__ . '/../../public/uploads/logos/' . $imageName);
            $ecosystem->setLogo($imageName);
            $ecosystem->setStatus($this->getReference('status_' . rand(0, 3)));
            $ecosystem->setActivity($faker->jobTitle);
            $ecosystem->setUrl($faker->url);
            $ecosystem->setAbstract($faker->text());
            $ecosystem->setPresentation($faker->text(800));
            $ecosystem->setIsValidated(true);
            $ecosystem->setEmail($faker->email);
            $ecosystem->setUser($this->getReference('member_' . $i));
            $manager->persist($ecosystem);
            $this->addReference('ecosystem_' . $i, $ecosystem);
        }
        for ($i = 30; $i < 50; $i++) {
            $ecosystem = new Ecosystem();
            $ecosystem->setName($faker->company);
            $image = 'https://loremflickr.com/200/200/';
            $imageName = uniqid() . '.jpg';
            copy($image, __DIR__ . '/../../public/uploads/logos/' . $imageName);
            $ecosystem->setLogo($imageName);
            $ecosystem->setStatus($this->getReference('status_' . rand(0, 3)));
            $ecosystem->setActivity($faker->jobTitle);
            $ecosystem->setUrl($faker->url);
            $ecosystem->setAbstract($faker->text());
            $ecosystem->setPresentation($faker->text(800));
            $ecosystem->setIsValidated(false);
            $ecosystem->setEmail($faker->email);
            $ecosystem->setUser($this->getReference('client_' . $i));
            $manager->persist($ecosystem);
            $this->addReference('ecosystem_' . $i, $ecosystem);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [StatusFixtures::class, UserFixtures::class];
    }
}
