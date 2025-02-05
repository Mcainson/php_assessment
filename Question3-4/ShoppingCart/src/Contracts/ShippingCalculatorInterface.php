<?php

declare(strict_types=1);

namespace ShoppingCart\Contracts;

use Brick\Math\BigDecimal;
use ShoppingCart\ValueObjects\Address;
use ShoppingCart\ValueObjects\Item;

interface ShippingCalculatorInterface
{
    /** @param array<\ShoppingCart\ValueObjects\Item> $items */
    public function calculate(Address $address, array $items): BigDecimal;
}