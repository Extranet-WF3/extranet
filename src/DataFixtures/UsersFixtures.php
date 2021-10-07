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
        $functions = ['Manager', 'Aprenant', 'Formateur'];

        

        $faker = Factory::create('fr_FR');
        //creation des utlisateurs
        for ($nbUsers = 1; $nbUsers <= 5; $nbUsers++) {
            $Users = new Users();


            $Users->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-30 days')));
            $Users->setUpdateAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-30 days')));
            $Users->setEmail($faker->email());
            $Users->setLastName($faker->lastname());
            $Users->setFirstName($faker->Firstname());
            $Users->setPseudo($faker->lastname() . $faker->firstname());
            $Users->setFunction($functions[array_rand($functions)]);
            $Users->setPassword('$2y$13$BWRnkAlTMAVuOk.tx01xheVAQ/9W.TNejmP7Xo2JeTPX1SKwAWDvu');
            if ($Users->getFunction() == 'Aprenant') {


                $Users->setSessionNumber(rand(1, 100));
                $Users->setTrainingYear(rand(1, 100));
            }


            $manager->persist($Users);
        }
        $admin = new Users();
        $admin->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-30 days')));
        $admin->setUpdateAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-30 days')));
        $admin->setEmail('admin@test.com');
        $admin->setLastName(('Martine'));
        $admin->setFirstName(('Ducornet'));
        $admin->setPseudo(('Martine') . ('Ducornet'));
        $admin->setFunction($functions[array_rand($functions)]);
        $admin->setPassword('$2y$13$BWRnkAlTMAVuOk.tx01xheVAQ/9W.TNejmP7Xo2JeTPX1SKwAWDvu');
        $manager->persist($admin);


        $manager->flush();



        $this->addReference("UserId", $Users);
        $this->addReference("TargetId", $Users);


    }
}
