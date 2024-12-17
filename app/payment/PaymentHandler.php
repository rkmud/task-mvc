<?php

declare(strict_types=1);

namespace App\payment;

interface PaymentHandler
{
    public function setNext(PaymentHandler $handler): PaymentHandler;

    public function handle(string $request): void;
}
