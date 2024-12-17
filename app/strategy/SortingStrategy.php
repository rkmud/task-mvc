<?php

declare(strict_types=1);

namespace App\strategy;

interface SortingStrategy
{
    public function sort(array $products): array;
}
