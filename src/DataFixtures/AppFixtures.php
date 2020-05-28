<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Command;
use App\Entity\CommandLine;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName("Romain");
        $user->setLastName("Billot");
        $user->setEmail("romainbillot3009@gmail.com");
        $user->setPassword("testtest");
        $manager->persist($user);

        $categorie = new Category();
        $categorie->setDescription("De bons fruits juteux");
        $categorie->setLabel("Fruits");
        $categorie->setImageUri("https://cdn.radiofrance.fr/s3/cruiser-production/2017/06/278886ff-903a-44f5-8b3f-984a98ff13ed/870x489_fruit_-_getty.jpg");
        $manager->persist($categorie);

        $product = new Product();
        $product->setLabel("Pomme");
        $product->setDescription("Une pomme sucrée !");
        $product->setImageUri("https://produits.bienmanger.com/35147-0w470h470_Pommes_Golden_Aop_Limousin_Bio.jpg");
        $product->setCategory($categorie);
        $product->setPrice(10);
        $product->setQuantity(100);
        $manager->persist($product);

        $command = new Command();
        $command->setCreatedAt(new \DateTime());
        $command->setStatus("pending");
        $command->setUser($user);
        $manager->persist($command);


        $command_line = new CommandLine();
        $command_line->setQuantity(1);
        $command_line->setPrice(10);
        $command_line->setProduct($product);
        $command_line->setCommand($command);
        $manager->persist($command_line);

        $manager->flush();
    }
}
