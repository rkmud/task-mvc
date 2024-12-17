<?php

declare (strict_types = 1);

namespace App\state;

class Order
{
    private OrderStatus $state;

    public function __construct()
    {
        $this->state = new WaitingPaymentState();
    }

    public function setState(OrderStatus $state): void
    {
        $this->state = $state;
    }

    public function handle(): void
    {
        $this->state->handle();
    }

    public function pay(): void
    {
        if ($this->state instanceof WaitingPaymentState) {
            $this->setState(new ProcessedState());
        }
    }

    public function process(): void
    {
        if ($this->state instanceof ProcessedState) {
            $this->setState(new ShippedState());
        }
    }

    public function ship(): void
    {
        if ($this->state instanceof ShippedState) {
            $this->setState(new DeliveredState());
        }
    }
}
