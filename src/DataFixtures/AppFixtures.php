<?php
namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager):void
    {
        $cat1=new Category();
        $cat1->setName('Ordinateurs');
        $manager->persist($cat1);


        $cat2=new Category();
        $cat2->setName('Smartphones');
        $manager->persist($cat2);

        $prod1=new Product();
        $prod1->setName('PC Asus');
        $prod1->setPrix(1200.50);
        $prod1->setDescription('Un ordinateur gamer tres puissant avec une carte graphique de derniere generation');
        $prod1->setCategory($cat1);
        $manager->persist($prod1);

        $prod2 = new Product();
        $prod2->setName('MacBook Pro');
        $prod2->setPrix(1500.00);
        $prod2->setDescription('Idéal pour les développeurs web et le design.');
        $prod2->setCategory($cat1);
        $manager->persist($prod2);

        $prod3 = new Product();
        $prod3->setName('iPhone 15');
        $prod3->setPrix(999.99);
        $prod3->setDescription('Le dernier smartphone avec un appareil photo incroyable.');
        $prod3->setCategory($cat2);
        $manager->persist($prod3);

        $manager->flush();
    }

}



