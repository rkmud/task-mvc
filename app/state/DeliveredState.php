<?php

declare( strict_types=1 );

namespace App\state;

class DeliveredState implements OrderStatus
{
    public function handle(): void
    {
        echo "The order is delivered";
    }
}
