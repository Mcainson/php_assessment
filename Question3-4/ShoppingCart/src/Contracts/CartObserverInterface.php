<?php

declare(strict_types=1);

namespace ShoppingCart\Contracts;

use ShoppingCart\ValueObjects\Item;

interface CartObserverInterface
{
    public function onItemAdded(Item $item): void;
    public function onItemRemoved(string $itemId): void;
}