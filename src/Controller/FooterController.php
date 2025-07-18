<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FooterController extends AbstractController
{
    #[Route('/mentions-legales', name: 'app_legal_notices', methods: ['GET','POST'])]
    public function legalNotices(): Response
    {
        return $this->render('footer/legal_notices.html.twig', []);
    }

    #[Route('/nous-contacter', name: 'app_contact', methods: ['GET','POST'])]
    public function contact(): Response
    {
        return $this->render('footer/contact.html.twig', []);
    }

    #[Route('/nos-services', name: 'app_services', methods: ['GET','POST'])]
    public function services(): Response
    {
        return $this->render('footer/services.html.twig', []);
    }
    #[Route('/cgv', name: 'app_cgv', methods: ['GET'])]
    public function cgv(): Response
    {
        return $this->render('footer/cgv.html.twig', []);
    }
}
