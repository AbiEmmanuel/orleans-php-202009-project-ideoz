<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OfferFixtures extends Fixture
{
    public const OFFERS = [
        'Transmettre - Former',
        'Conseil Flash',
        'Accompagnement',
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        foreach (self::OFFERS as $index => $offer) {
            $service = new Offer();
            $service->setName($offer);
            $service->setDescription($faker->text(700));
            $service->setAbstract($faker->text(400));
            $manager->persist($service);
            $this->addReference('offer_' . $index, $service);
        }
        $manager->flush();
    }
}
