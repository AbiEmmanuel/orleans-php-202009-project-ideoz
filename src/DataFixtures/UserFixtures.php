<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setEmail('wildschool.ideoz@gmail.com');
        $admin->setUsername('Administrateur');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'admin'));
        $manager->persist($admin);

        $enterprise = new User();
        $enterprise->setEmail('enterprise@email.com');
        $enterprise->setUsername('Entreprise');
        $enterprise->setRoles(['ROLE_ENTERPRISE']);
        $enterprise->setPassword($this->passwordEncoder->encodePassword($enterprise, 'enterprise'));
        $manager->persist($enterprise);

        $client = new User();
        $client->setEmail('client@email.com');
        $client->setUsername('Client');
        $client->setRoles(['ROLE_CLIENT']);
        $client->setPassword($this->passwordEncoder->encodePassword($client, 'client'));
        $manager->persist($client);

        $manager->flush();
    }
}
