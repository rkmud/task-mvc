<?php

namespace App\shipping;

class ExpressShippingHandler implements ShippingHandler
{
    private ?ShippingHandler $handler = null;

    public function setNext(ShippingHandler $handler): ShippingHandler
    {
        return $this->handler = $handler;
    }

    public function handle(string $request): void
    {
        if ($request === 'express') {
            echo "Processing express Shipping.\n";
        } elseif ($this->handler) {
            $this->handler->handle($request);
        } else {
            echo "No handler found for shipping method: $request.\n";
        }
    }
}
