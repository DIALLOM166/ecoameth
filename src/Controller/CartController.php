<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

//#[Route('/panier')]
class CartController extends AbstractController
{
    #[Route('/panier', name: 'cart_index')]
    public function index(CartService $cartService): Response
    {
        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getDetailedCartItems(),
            'total' => $cartService->getTotal(),
        ]);
    }

    #[Route('/cart/checkout', name: 'app_cart_checkout')]
    public function checkout(): Response
    {
        // Tu peux récupérer les infos du panier ici, vérifier les données, etc.

        return $this->render('cart/checkout.html.twig', [
            // passer les données nécessaires à la vue
        ]);
    }


    #[Route('/add/{id}', name: 'cart_add')]
    public function add(int $id, CartService $cartService): Response
    {
        $cartService->add($id);
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/decrement/{id}', name: 'cart_decrement')]
    public function decrement(int $id, CartService $cartService): Response
    {
        $cartService->decrement($id);
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/remove/{id}', name: 'cart_remove')]
    public function remove(int $id, CartService $cartService): Response
    {
        $cartService->remove($id);
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/clear', name: 'cart_clear')]
    public function clear(CartService $cartService): Response
    {
        $cartService->clear();
        return $this->redirectToRoute('cart_index');
    }
}
