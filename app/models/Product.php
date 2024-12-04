<?php

declare(strict_types=1);

namespace App\models;

final class Product
{
    public function __construct(
        public int $id,
        public string $name,
        public float $price,
    ) {}

    public function getPriceWithDiscount(float $discount): float
    {
        return $this->price - ($this->price * $discount);
    }
}
