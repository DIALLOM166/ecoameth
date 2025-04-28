<?php

namespace App\Controller;

use App\Entity\Shipment;
use App\Form\ShipmentType;
use App\Repository\ShipmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/shipment')]
final class ShipmentController extends AbstractController
{
    #[Route(name: 'app_shipment_index', methods: ['GET'])]
    public function index(ShipmentRepository $shipmentRepository): Response
    {
        return $this->render('shipment/index.html.twig', [
            'shipments' => $shipmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_shipment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $shipment = new Shipment();
        $form = $this->createForm(ShipmentType::class, $shipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($shipment);
            $entityManager->flush();

            return $this->redirectToRoute('app_shipment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('shipment/new.html.twig', [
            'shipment' => $shipment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_shipment_show', methods: ['GET'])]
    public function show(Shipment $shipment): Response
    {
        return $this->render('shipment/show.html.twig', [
            'shipment' => $shipment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_shipment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Shipment $shipment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ShipmentType::class, $shipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_shipment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('shipment/edit.html.twig', [
            'shipment' => $shipment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_shipment_delete', methods: ['POST'])]
    public function delete(Request $request, Shipment $shipment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shipment->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($shipment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_shipment_index', [], Response::HTTP_SEE_OTHER);
    }
}
