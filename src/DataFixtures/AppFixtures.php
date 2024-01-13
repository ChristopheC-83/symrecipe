<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture

{

    public Generator $faker;

    public function __construct (){ 
    
            $this->faker = Factory::create('fr_FR');
    
    }
    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i < 51; $i++) {



            $ingredient = new Ingredient();
            $ingredient->setName($this->faker->word())
                ->setPrice( rand(1, 100) / 10)
                ->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($ingredient);
        }

        $manager->flush();
    }
}
