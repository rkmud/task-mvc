<?php

declare(strict_types=1);

namespace App\payment;

class PayPalPaymentHandler implements PaymentHandler
{
    private ?PaymentHandler $handler = null;

    public function setNext(PaymentHandler $handler): PaymentHandler
    {
        return $this->handler = $handler;
    }

    public function handle(string $request): void
    {
        if ($request === 'paypal') {
            echo "Processing payment via PayPal.\n";
        } elseif ($this->handler) {
            $this->handler->handle($request);
        } else {
            echo "No handler found for payment method: $request.\n";
        }
    }
}
