<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public const STATUS = [
        'Client',
        'Partenaire',
        'Adhérent',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::STATUS as $index => $name) {
            $status = new Status();
            $status->setName($name);
            $manager->persist($status);
            $this->addReference('status_' . $index, $status);
        }
        $manager->flush();
    }
}
