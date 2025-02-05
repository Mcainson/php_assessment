<?php

declare(strict_types=1);

namespace ShoppingCart\Services;

use ShoppingCart\Contracts\CartObserverInterface;
use ShoppingCart\ValueObjects\Item;

class CartLogger implements CartObserverInterface
{
    public function onItemAdded(Item $item): void
    {
        error_log("Item added: {$item->name}");
    }

    public function onItemRemoved(string $itemId): void
    {
        error_log("Item removed: {$itemId}");
    }
}