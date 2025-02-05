<?php

declare(strict_types=1);

namespace ShoppingCart;

use Brick\Math\BigDecimal;

use InvalidArgumentException;
use ShoppingCart\Contracts\CartObserverInterface;
use ShoppingCart\Contracts\ShippingCalculatorInterface;
use ShoppingCart\Models\Customer;
use ShoppingCart\ValueObjects\Address;
use ShoppingCart\ValueObjects\Item;

class Cart
{
    private const TAX_RATE = '0.07';

    private ?Customer $customer = null;
    private ?Address $shippingAddress = null;
    /** @var array<Item> */
    private array $items = [];
    /** @var array<CartObserverInterface> */
    private array $observers = [];

    public function __construct(
        private readonly ShippingCalculatorInterface $shippingCalculator
    ) {}

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function setShippingAddress(Address $address): void
    {
        $this->shippingAddress = $address;
    }

    public function addItem(Item $item): void
    {
        $this->items[] = $item;
        foreach ($this->observers as $observer) {
            $observer->onItemAdded($item);
        }
    }

    public function removeItem(string $itemId): void
    {
        $this->items = array_filter(
            $this->items,
            fn(Item $item) => $item->id !== $itemId
        );
        foreach ($this->observers as $observer) {
            $observer->onItemRemoved($itemId);
        }
    }

    public function addObserver(CartObserverInterface $observer): void
    {
        $this->observers[] = $observer;
    }

    public function getSubtotal(): BigDecimal
    {
        return array_reduce(
            $this->items,
            fn(BigDecimal $carry, Item $item) => $carry->plus($item->getSubtotal()),
            BigDecimal::of('0')
        );
    }

    public function getTax(): BigDecimal
    {
        return $this->getSubtotal()->multipliedBy(self::TAX_RATE);
    }

    public function getShipping(): BigDecimal
    {
        if (!$this->shippingAddress) {
            throw new InvalidArgumentException('Shipping address must be set');
        }
        return BigDecimal::of($this->shippingCalculator->calculate($this->shippingAddress, $this->items));
    }

    public function getTotal(): BigDecimal
    {
        return $this->getSubtotal()
            ->plus($this->getTax())
            ->plus($this->getShipping());
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        if (!$this->customer) {
            throw new InvalidArgumentException('Customer must be set');
        }

        return [
            'customer' => [
                'name' => $this->customer->getFullName(),
                'shipping_address' => $this->shippingAddress ? [
                    'line1' => $this->shippingAddress->line1,
                    'line2' => $this->shippingAddress->line2,
                    'city' => $this->shippingAddress->city,
                    'state' => $this->shippingAddress->state,
                    'zip' => $this->shippingAddress->zip,
                ] : null,
            ],
            'items' => array_map(
                fn(Item $item) => [
                    'id' => $item->id,
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'price' => (string)$item->price,
                    'subtotal' => (string)$item->getSubtotal(),
                ],
                $this->items
            ),
            'summary' => [
                'subtotal' => (string)$this->getSubtotal(),
                'tax' => (string)$this->getTax(),
                'shipping' => (string)$this->getShipping(),
                'total' => (string)$this->getTotal(),
            ],
        ];
    }
}