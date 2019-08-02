<?php

namespace App\DataFixtures;
use  App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SuperuserFixtures extends Fixture
{

    private $encoder;

public function __construct(UserPasswordEncoderInterface $encoder)
{
    $this->encoder = $encoder;
}

    public function load(ObjectManager $manager)
    {
         $user = new User();
         $user->setUsername("cheikh");
         $user->setRoles(['ROLE_SUPERADMIN']);
         $user->setPassword("test");
         $user->setNom("seck");
         $user->setTel(778931215);
         $user->setAdresse("adresse");
          
         $user->setPhoto("img");
         $user->setCni("0088199300189");


        $manager->persist($user);

        $manager->flush();
    }
}