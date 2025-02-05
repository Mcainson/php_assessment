<?php

declare(strict_types=1);

namespace ShoppingCart\Services\ShippingCalculators;

use Brick\Math\BigDecimal;
use ShoppingCart\Contracts\ShippingCalculatorInterface;
use ShoppingCart\ValueObjects\Address;
use ShoppingCart\ValueObjects\Item;

class DefaultShippingCalculator implements ShippingCalculatorInterface
{
    /** @param array<Item> $items */
    public function calculate(Address $address, array $items): BigDecimal
    {
        return BigDecimal::of('10.00');
    }
}