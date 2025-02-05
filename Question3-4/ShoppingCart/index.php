<?php

require 'vendor/autoload.php';

use ShoppingCart\CartBuilder;
use ShoppingCart\Models\Customer;
use ShoppingCart\Services\ShippingCalculators\DefaultShippingCalculator;
use ShoppingCart\ValueObjects\Address;

$shippingCalculator = new DefaultShippingCalculator();
$cartBuilder = new CartBuilder($shippingCalculator);

$cart = $cartBuilder
    ->setCustomer(new Customer(
        firstName: 'Makenson',
        lastName: 'Clervil'
    ))
    ->setShippingAddress(new Address(
        line1: '123 Main St',
        line2: null,
        city: 'CDMX',
        state: 'Mexico',
        zip: '63735'
    ))
    ->addItem(
        id: '1',
        name: 'Watch',
        quantity: 2,
        price: '9.99'
    )
    ->getCart();

$summary = $cart->toArray();
print_r($summary);