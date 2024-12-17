<?php

namespace App\payment;

class CreditCardPaymentHandler implements PaymentHandler
{
    private ?PaymentHandler  $nextHandler = null;
    public function setNext(PaymentHandler $handler): PaymentHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(string $request): void
    {
        if ($request === 'credit_card') {
            echo "Processing payment via Credit Card.\n";
        } elseif ($this->nextHandler) {
            $this->nextHandler->handle($request);
        } else {
            echo "No handler found for payment method: $request.\n";
        }
    }
}
