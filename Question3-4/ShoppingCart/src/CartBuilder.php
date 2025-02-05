<?php

declare(strict_types=1);

namespace ShoppingCart;

use Brick\Math\BigDecimal;
use ShoppingCart\Contracts\ShippingCalculatorInterface;
use ShoppingCart\Models\Customer;
use ShoppingCart\ValueObjects\Address;
use ShoppingCart\ValueObjects\Item;

class CartBuilder
{
    private Cart $cart;

    public function __construct(
        private readonly ShippingCalculatorInterface $shippingCalculator
    ) {
        $this->reset();
    }

    public function reset(): void
    {
        $this->cart = new Cart($this->shippingCalculator);
    }

    public function setCustomer(Customer $customer): self
    {
        $this->cart->setCustomer($customer);
        return $this;
    }

    public function setShippingAddress(Address $address): self
    {
        $this->cart->setShippingAddress($address);
        return $this;
    }

    public function addItem(
        string $id,
        string $name,
        int $quantity,
        string|float|BigDecimal $price
    ): self {
        $price = $price instanceof BigDecimal ? $price : BigDecimal::of((string) $price);

        $item = new Item(
            id: $id,
            name: $name,
            quantity: $quantity,
            price: $price
        );

        $this->cart->addItem($item);
        return $this;
    }

    public function getCart(): Cart
    {
        $cart = $this->cart;
        $this->reset();
        return $cart;
    }
}