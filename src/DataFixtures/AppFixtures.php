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
        // Création des catégories
        $categories = [
            'Soins Visage' => [
                'description' => 'Produits de soin pour le visage : crèmes, sérums, nettoyants',
                'color' => '#ff6b6b'
            ],
            'Soins Capillaires' => [
                'description' => 'Shampooings, après-shampooings, masques pour cheveux',
                'color' => '#4ecdc4'
            ],
            'Soins Corps' => [
                'description' => 'Hydratants, gommages, huiles pour le corps',
                'color' => '#45b7d1'
            ],
            'Maquillage' => [
                'description' => 'Fond de teint, rouge à lèvres, mascara',
                'color' => '#f9ca24'
            ],
            'Soins Naturels' => [
                'description' => 'Produits bio et naturels pour tous types de peau',
                'color' => '#6c5ce7'
            ]
        ];

        $categoryEntities = [];
        foreach ($categories as $name => $data) {
            $category = new Category();
            $category->setName($name);
            $category->setDescription($data['description']);
            $category->setColor($data['color']);
            $manager->persist($category);
            $categoryEntities[$name] = $category;
        }

        // Données des produits avec plus de variété
        $products = [
            // Soins Visage
            [
                'name' => 'Crème Hydratante Aloe Vera Bio',
                'price' => 24.90,
                'description' => 'Crème visage hydratante enrichie en aloe vera bio et acide hyaluronique. Convient aux peaux sensibles et mixtes. Texture légère et non grasse.',
                'image' => 'creme-visage-aloe.png',
                'categories' => ['Soins Visage', 'Soins Naturels'],
                'stock' => 45,
                'featured' => true
            ],
            [
                'name' => 'Sérum Vitamine C Anti-Âge',
                'price' => 32.50,
                'description' => 'Sérum concentré en vitamine C pour lutter contre les signes du vieillissement. Effet antioxydant et éclaircissant immédiat.',
                'image' => 'serum-vitamine-c.png',
                'categories' => ['Soins Visage'],
                'stock' => 28,
                'featured' => false
            ],
            [
                'name' => 'Lotion Tonique Purifiante',
                'price' => 16.80,
                'description' => 'Lotion tonique à base d\'hamamélis et d\'aloe vera pour purifier et équilibrer la peau. Sans alcool, convient aux peaux sensibles.',
                'image' => 'lotion-tonique.png',
                'categories' => ['Soins Visage', 'Soins Naturels'],
                'stock' => 62,
                'featured' => false
            ],
            [
                'name' => 'Masque Hydratant Overnight',
                'price' => 28.00,
                'description' => 'Masque de nuit hydratant intensif à l\'acide hyaluronique et aux peptides. Réveil avec une peau repulpée et éclatante.',
                'image' => 'masque-nuit.png',
                'categories' => ['Soins Visage'],
                'stock' => 35,
                'featured' => true
            ],
            [
                'name' => 'Nettoyant Visage Mousse Douce',
                'price' => 18.90,
                'description' => 'Mousse nettoyante douce aux extraits de camomille et aloe vera. Nettoie en profondeur sans dessécher la peau.',
                'image' => 'nettoyant-mousse.png',
                'categories' => ['Soins Visage', 'Soins Naturels'],
                'stock' => 52,
                'featured' => false
            ],

            // Soins Capillaires
            [
                'name' => 'Shampooing Réparateur Keratin Complex',
                'price' => 22.90,
                'description' => 'Shampooing professionnel à la kératine et aux huiles essentielles. Répare et renforce les cheveux abîmés et colorés.',
                'image' => 'shampoo-keratin.png',
                'categories' => ['Soins Capillaires'],
                'stock' => 38,
                'featured' => true
            ],
            [
                'name' => 'Après-Shampooing Nutrition Intense',
                'price' => 19.50,
                'description' => 'Après-shampooing enrichi en beurre de karité et huile d\'argan. Démêle et nourrit les cheveux secs et frisés.',
                'image' => 'conditioner-nutrition.png',
                'categories' => ['Soins Capillaires'],
                'stock' => 41,
                'featured' => false
            ],
            [
                'name' => 'Masque Capillaire Reconstructeur',
                'price' => 26.80,
                'description' => 'Masque de soin intensif aux protéines de soie et huiles végétales. Traitement hebdomadaire pour cheveux très abîmés.',
                'image' => 'masque-reconstructeur.png',
                'categories' => ['Soins Capillaires'],
                'stock' => 29,
                'featured' => true
            ],
            [
                'name' => 'Huile Capillaire Précieuse',
                'price' => 31.20,
                'description' => 'Huile de soin aux 7 huiles précieuses (argan, jojoba, avocat...). Nourrit, protège et fait briller les cheveux.',
                'image' => 'huile-capillaire.png',
                'categories' => ['Soins Capillaires', 'Soins Naturels'],
                'stock' => 24,
                'featured' => false
            ],

            // Soins Corps
            [
                'name' => 'Crème Corps Hydratante 24H',
                'price' => 21.90,
                'description' => 'Crème corps à absorption rapide avec beurre de karité et glycérine. Hydratation longue durée pour peaux sèches.',
                'image' => 'creme-corps.png',
                'categories' => ['Soins Corps', 'Soins Naturels'],
                'stock' => 56,
                'featured' => false
            ],
            [
                'name' => 'Gommage Corps Exfoliant Doux',
                'price' => 24.50,
                'description' => 'Gommage corps aux cristaux de sucre et huiles essentielles. Exfolie en douceur et laisse la peau douce et parfumée.',
                'image' => 'gommage-corps.png',
                'categories' => ['Soins Corps'],
                'stock' => 33,
                'featured' => true
            ],
            [
                'name' => 'Huile Sèche Multi-Usage',
                'price' => 18.80,
                'description' => 'Huile sèche pour visage, corps et cheveux. Formule légère aux huiles d\'argan et de jojoba, absorption immédiate.',
                'image' => 'huile-seche.png',
                'categories' => ['Soins Corps', 'Soins Naturels'],
                'stock' => 47,
                'featured' => false
            ],

            // Maquillage
            [
                'name' => 'Fond de Teint Longue Tenue',
                'price' => 29.90,
                'description' => 'Fond de teint couvrance modulable avec SPF 15. Tenue 12H, fini naturel. Disponible en 12 teintes.',
                'image' => 'fond-teint.png',
                'categories' => ['Maquillage'],
                'stock' => 72,
                'featured' => true
            ],
            [
                'name' => 'Rouge à Lèvres Velours',
                'price' => 16.90,
                'description' => 'Rouge à lèvres mat longue tenue aux pigments intenses. Formule enrichie en vitamine E et beurre de karité.',
                'image' => 'rouge-levres.png',
                'categories' => ['Maquillage'],
                'stock' => 89,
                'featured' => false
            ],
            [
                'name' => 'Mascara Volume Intense',
                'price' => 22.50,
                'description' => 'Mascara effet volume et longueur avec brosse ergonomique. Formule waterproof enrichie en cires naturelles.',
                'image' => 'mascara-volume.png',
                'categories' => ['Maquillage'],
                'stock' => 67,
                'featured' => true
            ]
        ];

        // Création des produits
        foreach ($products as $productData) {
            $product = new Product();
            $product->setName($productData['name']);
            $product->setPrice($productData['price']);
            $product->setDescription($productData['description']);
            $product->setCreatedAt(new \DateTime());
            $product->setStock($productData['stock']);
            $product->setFeatured($productData['featured'] ?? false);
            
            // Ajout des catégories
            foreach ($productData['categories'] as $categoryName) {
                $product->addCategory($categoryEntities[$categoryName]);
            }

            // Création de l'image associée
            $image = new Image();
            // $image->setFilePath($productData['image']);
            $image->setFilePath('products/' . $productData['image']);

            $image->setUploadedAt(new \DateTime());
            $image->setProduct($product);

            $manager->persist($product);
            $manager->persist($image);
        }

        // Sauvegarde en base de données
        $manager->flush();
    }
}