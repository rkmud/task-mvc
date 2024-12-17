<?php

namespace App\controllers;

abstract class OrderProcessor
{
    final public function processOrder(string $paymentMethod, string $shippingMethod): void
    {
        $this->getProducts();
        $this->choosePaymentMethod($paymentMethod);
        $this->chooseShippingMethod($shippingMethod);
        $this->processOrderDetails();
    }

    protected function getProducts(): void
    {
        echo "Getting products...\n";
    }

    abstract protected function choosePaymentMethod(string $paymentMethod): void;

    abstract protected function chooseShippingMethod(string $shippingMethod): void;

    protected function processOrderDetails(): void
    {
        echo "Processing order details...\n";
    }
}
