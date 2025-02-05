<?php

declare(strict_types=1);

namespace ShoppingCart\Repositories;

use ShoppingCart\Cart;

class CartRepository
{
    /** @var array<string, Cart> */
    private array $carts = [];

    public function save(string $cartId, Cart $cart): void
    {
        $this->carts[$cartId] = $cart;
    }

    public function find(string $cartId): ?Cart
    {
        return $this->carts[$cartId] ?? null;
    }

    public function remove(string $cartId): void
    {
        unset($this->carts[$cartId]);
    }
}