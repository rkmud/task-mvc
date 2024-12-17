<?php

declare (strict_types = 1);

namespace App\state;

interface OrderStatus
{
    public function handle(): void;
}
