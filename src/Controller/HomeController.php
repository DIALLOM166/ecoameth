<?php

namespace App\Controller;

use index;
use DateTimeImmutable;
use App\Entity\Product;
use App\Entity\Category;
use App\Form\CommentType;
use App\Form\ProductFilterType;
use App\Repository\ProductRepository;
use PHPStan\PhpDocParser\Ast\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET','POST'])]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }

    
    #[Route('/catalog', name:'app_catalog')]
    // #[IsGranted('ROLE_ADMIN')]
    public function catalog(ProductRepository $productRepository, Request $request): Response
    {

        $form = $this->createForm(ProductFilterType::class);
        $form->handleRequest($request);

        $search = $form->get('search')->getData();
        $order = $form->get('order')->getData();
        $categories = $form->get('categories')->getData();
        // dump($categories);
        
        $products = $productRepository->findProductFilter($search, $order, $categories);

        return $this->render('home/catalog.html.twig', [
            'products' => $products,
            'form' => $form->createView()
        ]);
    }

    #[Route('/catalog/{id}', name:'app_catalog_category')]
    public function catalogCategory(Category $category, ProductRepository $productRepository): Response
    {
        $products = $productRepository->findBy(['status' => true, 'category' => $category]); 

        return $this->render('home/catalog_category.html.twig', [
            'products' => $products,
            'category' => $category
        ]);
    }

    #[Route('/product/{id}', name:'app_catalog_product')]
    public function productFiche(Product $product, Request $request, EntityManagerInterface $em): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()) {
            
            $comment->setUser($this->getUser());
            $comment->setProduct($product);
            $comment->setCreatedAt(new DateTimeImmutable('now'));

            $em->persist($comment);
            $em->flush();
            $this->addFlash('success', 'Merci pour votre commentaire, il sera traîté dans les plus brefs délais');
            $this->redirectToRoute('app_catalog_product', ['id' => $product->getId()]);
        }


        return $this->render('home/product.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }



}
