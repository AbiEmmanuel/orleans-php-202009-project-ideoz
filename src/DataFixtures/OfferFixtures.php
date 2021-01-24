<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OfferFixtures extends Fixture
{
    public const OFFERS = [
        'Formation et transmission',
        'Conseil',
        'Accompagnement engagé',
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        foreach (self::OFFERS as $index => $offer) {
            $service = new Offer();
            $service->setName($offer);
            $service->setDescription($faker->text(700));
            $service->setAbstract($faker->text(400));
            $service->setCatchPhrase($faker->sentence);
            $service->setExample($faker->text(600));
            $service->setNumber($index + 1);
            $manager->persist($service);
            $this->addReference('offer_' . $index, $service);
        }
        $manager->flush();
    }
}
