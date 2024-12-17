<?php

namespace App\strategy;

class SortingStrategyByPrice implements SortingStrategy
{
    public function sort(array $products): array
    {
        usort($products, fn ($a, $b) => $a['price'] <=> $b['price']);
        return $products;
    }
}
