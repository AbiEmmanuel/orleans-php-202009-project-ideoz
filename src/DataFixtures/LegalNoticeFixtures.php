<?php

namespace App\DataFixtures;

use App\Entity\LegalNotice;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LegalNoticeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $legalNotice = new LegalNotice();
        $legalNotice->setContent($faker->text(600));
        $manager->persist($legalNotice);
        $manager->flush();
    }
}
