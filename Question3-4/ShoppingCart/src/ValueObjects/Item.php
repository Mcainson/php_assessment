<?php

declare(strict_types=1);

namespace ShoppingCart\ValueObjects;

use Brick\Math\BigDecimal;

readonly class Item
{
    public function __construct(
        public string $id,
        public string $name,
        public int $quantity,
        public BigDecimal $price,
    ) {}

    public function getSubtotal(): BigDecimal
    {
        return $this->price->multipliedBy($this->quantity);
    }
}