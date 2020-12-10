<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $company = new Company();
        $company->setName($faker->word);
        $company->setPhoneNumber($faker->phoneNumber);
        $company->setEmail($faker->email);
        $manager->persist($company);
        $manager->flush();
    }
}
