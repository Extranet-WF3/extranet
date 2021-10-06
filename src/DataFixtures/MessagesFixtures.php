<?php

namespace Controller\DataFixtures\MessagesFixtures;
use App\Entity\Messages;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Message extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($nbMessages= 1; $nbMessages <50; $nbMessages++){

            $product = new Messages();
            $product->SetObject($faker->sentence(30));
            $product->SetStatus($faker->text);
            $product->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('now', '+30 years')));
        }



        $manager->persist($product);
        $manager->flush();
    }
}
