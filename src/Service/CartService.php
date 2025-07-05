<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\ProductRepository;

class CartService
{
    private $session;
    private ProductRepository $productRepository;

    public function __construct(RequestStack $requestStack, ProductRepository $productRepository)
    {
        $this->session = $requestStack->getSession();
        $this->productRepository = $productRepository;
    }

    public function add(int $productId): void
    {
        $cart = $this->session->get('cart', []);

        if (!isset($cart[$productId])) {
            $cart[$productId] = 0;
        }

        $cart[$productId]++;
        $this->session->set('cart', $cart);
    }

    public function decrement(int $productId): void
    {
        $cart = $this->session->get('cart', []);

        if (!isset($cart[$productId])) {
            return;
        }

        $cart[$productId]--;

        if ($cart[$productId] <= 0) {
            unset($cart[$productId]);
        }

        $this->session->set('cart', $cart);
    }

    public function remove(int $productId): void
    {
        $cart = $this->session->get('cart', []);
        unset($cart[$productId]);
        $this->session->set('cart', $cart);
    }

    public function clear(): void
    {
        $this->session->remove('cart');
    }

    public function getCart(): array
    {
        return $this->session->get('cart', []);
    }

    public function getDetailedCartItems(): array
    {
        $cart = $this->getCart();
        $detailedCart = [];

        foreach ($cart as $id => $quantity) {
            $product = $this->productRepository->find($id);

            if (!$product) {
                continue;
            }

            $detailedCart[] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
        }

        return $detailedCart;
    }

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->getDetailedCartItems() as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }

        return $total;
    }
}
