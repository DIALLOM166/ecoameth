<?php

namespace App\Controller;

use index;
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

    #[Route('/catalog', name: 'app_catalog')]
    public function catalog(): Response
    {
        return $this->render('home/catalog.html.twig');
    }


}
