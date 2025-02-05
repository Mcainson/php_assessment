<?php

declare(strict_types=1);

namespace ShoppingCart\ValueObjects;

readonly class Address
{
    public function __construct(
        public string $line1,
        public ?string $line2,
        public string $city,
        public string $state,
        public string $zip,
    ) {}
}