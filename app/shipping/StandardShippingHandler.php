<?php

namespace App\shipping;

class StandardShippingHandler implements ShippingHandler
{
    private ?ShippingHandler $handler = null;

    public function setNext(ShippingHandler $handler): ShippingHandler
    {
        return $this->handler = $handler;
    }

    public function handle(string $request): void
    {
        if ($request === 'standard') {
            echo "Processing Standard Shipping.\n";
        } elseif ($this->handler) {
            $this->handler->handle($request);
        } else {
            echo "No handler found for shipping method: $request.\n";
        }
    }
}
