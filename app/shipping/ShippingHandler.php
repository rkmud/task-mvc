<?php

namespace App\shipping;

interface ShippingHandler
{
    public function setNext(ShippingHandler $handler): ShippingHandler;

    public function handle(string $request): void;
}
