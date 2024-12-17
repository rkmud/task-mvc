<?php

namespace App\strategy;

class SortingStrategyByRating implements SortingStrategy
{
    public function sort (array $products): array
    {
        usort($products, fn ($a, $b) => $a['rating'] <=> $b['rating']);
        return $products;
    }
}
