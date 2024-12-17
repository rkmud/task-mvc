<?php

declare(strict_types=1);

namespace App\strategy;

class SortingStrategyByName implements SortingStrategy
{
    public function sort(array $products): array
    {
        usort($products, fn ($a, $b) => strcmp($a['name'], $b['name']));
        return $products;
    }

}
