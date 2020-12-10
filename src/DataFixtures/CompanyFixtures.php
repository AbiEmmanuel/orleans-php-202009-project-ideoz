<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    private const NAME = 'Simon Abraham';
    private const PHONE_NUMBER = '0661992159';
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $company = new Company();
        $company->setName(self::NAME);
        $company->setPhoneNumber(self::PHONE_NUMBER);
        $company->setEmail($faker->email);
        $manager->persist($company);
        $manager->flush();
    }
}
