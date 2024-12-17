<?php

declare (strict_types = 1);

namespace App\state;

class WaitingPaymentState implements OrderStatus
{
    public function handle(): void
    {
        echo "The order's waiting payment";
    }
}
