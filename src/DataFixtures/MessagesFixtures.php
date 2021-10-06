<?php

namespace Controller\DataFixtures\MessagesFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Messages extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = new Messages();
        $product->setObject("cdi, alternance, cdd");
        $product->setstatus("Votre status");


        $manager->persist($product);
        $manager->flush();
    }
}
