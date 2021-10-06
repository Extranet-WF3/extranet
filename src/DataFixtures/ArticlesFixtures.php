<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $article = new Articles();

            // On crée une phrase aléatoire de 50 mots
            $article->settitle($faker->sentence(50));

            $article->setSlug($faker->slug());

            // On crée une texte aléatoire de 200 mots
            $article->setDescription($faker->text(200));

            // On crée un mot aléatoirement
            $article->setCategories($faker->word());

            $article->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-30 days')));

            // On génère aléatoirement une url
            $article->setoriginalLink($faker->url());

            // Pour le test on passe l'user_id à nulle
            $article->setUser(null);

            $manager->persist($article);
        }

        $manager->flush();
    }
}
