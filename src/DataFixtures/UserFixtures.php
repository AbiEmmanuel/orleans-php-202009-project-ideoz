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
        $admin->setIsVerified(true);
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'admin'));
        $manager->persist($admin);

        for ($i = 0; $i < 30; $i++) {
            $membre = new User();
            $membre->setEmail('member' . $i . '@email.com');
            $membre->setUsername('Membre');
            $membre->setRoles(['ROLE_MEMBER']);
            $membre->setIsVerified(true);
            $membre->setPassword($this->passwordEncoder->encodePassword($membre, 'membre'));
            $manager->persist($membre);
            $this->addReference('member_' . $i, $membre);
        }
        for ($i = 30; $i < 50; $i++) {
            $client = new User();
            $client->setEmail('client' . $i . '@email.com');
            $client->setUsername('client');
            $client->setRoles(['ROLE_USER']);
            $client->setIsVerified(false);
            $client->setPassword($this->passwordEncoder->encodePassword($client, 'client'));
            $manager->persist($client);
            $this->addReference('client_' . $i, $client);
        }
        $manager->flush();
    }
}
