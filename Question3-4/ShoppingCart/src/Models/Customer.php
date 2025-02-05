<?php

declare(strict_types=1);

namespace ShoppingCart\Models;

use ShoppingCart\ValueObjects\Address;

class Customer
{
    /** @param array<Address> $addresses */
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        private array $addresses = [],
    ) {}

    public function getFullName(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }

    public function addAddress(Address $address): void
    {
        $this->addresses[] = $address;
    }

    /** @return array<Address> */
    public function getAddresses(): array
    {
        return $this->addresses;
    }
}