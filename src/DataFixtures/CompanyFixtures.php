<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    private const NAME = 'Simon Abraham';
    private const PHONE_NUMBER = '0661992159';
    private const EMAIL = 'zideo2020@gmail.com';
    private const COMPANY_NAME = 'IdeOZ';

    public function load(ObjectManager $manager)
    {
        $company = new Company();
        $company->setName(self::NAME);
        $company->setPhoneNumber(self::PHONE_NUMBER);
        $company->setEmail(self::EMAIL);
        $manager->persist($company);
        $manager->flush();
    }
}
