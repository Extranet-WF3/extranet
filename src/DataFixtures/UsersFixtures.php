<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class UsersFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $functions = ['Admin', 'Apprenti'];

        $faker = Factory::create('fr_FR');
        //creation des utlisateurs
        for ($nbUsers = 1; $nbUsers <= 5; $nbUsers++) {
            $Users = new Users();
            $Users->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-30 days')));
            $Users->setUpdateAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-30 days')));
            $Users->setEmail($faker->email());
            $Users->setLastName($faker->lastname());
            $Users->setFirstName($faker->Firstname());
            $Users->setPseudo($faker->lastname().$faker->firstname());
            $Users->setFunction($functions[array_rand($functions)]);
            $Users->setSessionNumber(rand(1, 100));
            $Users->setTrainingYear(rand(1, 100));
            $Users->setPassword('$2y$13$ZxREluDrZma0qettrENIwufq7znBcCGI5JNJ.1gr3smwt/ksjFqq.');

            $manager->persist($Users);
        }

        $manager->flush();
    }
}
