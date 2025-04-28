<?php

namespace App\Controller;

use App\Entity\OrderItems;
use App\Form\OrderItemsType;
use App\Repository\OrderItemsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/order/items')]
final class OrderItemsController extends AbstractController
{
    #[Route(name: 'app_order_items_index', methods: ['GET'])]
    public function index(OrderItemsRepository $orderItemsRepository): Response
    {
        return $this->render('order_items/index.html.twig', [
            'order_items' => $orderItemsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_order_items_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $orderItem = new OrderItems();
        $form = $this->createForm(OrderItemsType::class, $orderItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($orderItem);
            $entityManager->flush();

            return $this->redirectToRoute('app_order_items_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('order_items/new.html.twig', [
            'order_item' => $orderItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_order_items_show', methods: ['GET'])]
    public function show(OrderItems $orderItem): Response
    {
        return $this->render('order_items/show.html.twig', [
            'order_item' => $orderItem,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_order_items_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OrderItems $orderItem, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrderItemsType::class, $orderItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_order_items_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('order_items/edit.html.twig', [
            'order_item' => $orderItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_order_items_delete', methods: ['POST'])]
    public function delete(Request $request, OrderItems $orderItem, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orderItem->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($orderItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_order_items_index', [], Response::HTTP_SEE_OTHER);
    }
}
