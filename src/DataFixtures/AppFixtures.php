<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création de la catégorie Aloe Vera
        $category = new Category();
        $category->setName('Aloe Vera');
        $manager->persist($category);

        // Données des produits
        $products = [
            [
                'name' => 'Crème visage aloe vera',
                'price' => 18.50,
                'description' => 'Crème nourrissante pour peau sensible à base d\'aloe vera bio',
                'image' => 'creme-visage.png'
            ],
            [
                'name' => 'Lotion tonique aloe vera',
                'price' => 14.00,
                'description' => 'Lotion rafraîchissante et purifiante à l\'aloe vera et camomille',
                'image' => 'lotion-tonique.png'
            ],
            [
                'name' => 'Masque hydratant aloe vera',
                'price' => 16.80,
                'description' => 'Masque en tissu pour le visage avec effet apaisant immédiat',
                'image' => 'masque-hydratant.png'
            ],
            [
                'name' => 'Nettoyant visage aloe vera',
                'price' => 13.50,
                'description' => 'Nettoyant doux pour le visage à l\'extrait d\'aloe vera bio',
                'image' => 'nettoyant-visage.png'
            ],
            [
                'name' => 'Gel d\'aloe vera pur',
                'price' => 12.90,
                'description' => 'Gel naturel à 99% d\'aloe vera qui hydrate et apaise la peau',
                'image' => 'gel-aloe.png'
            ]
        ];

        // Création des produits et de leurs images
        foreach ($products as $productData) {
            $product = new Product();
            $product->setName($productData['name']);
            $product->setPrice($productData['price']);
            $product->setDescription($productData['description']);
            $product->setCreatedAt(new \DateTime());
            $product->setStock(random_int(10, 100));
            $product->addCategory($category);

            // Création de l'image associée
            $image = new Image();
            $image->setFilePath($productData['image']);
            $image->setUploadedAt(new \DateTime());
            $image->setProduct($product);

            $manager->persist($product);
            $manager->persist($image);
        }

        // Sauvegarde en base de données
        $manager->flush();
    }
}