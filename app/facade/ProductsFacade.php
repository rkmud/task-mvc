<?php

declare(strict_types=1);

namespace App\facade;

use App\dataProviders\ArrayProductsDataProvider;
use App\strategy\SortingStrategy;
use App\strategy\SortingStrategyByName;
use App\strategy\SortingStrategyByPrice;
use App\strategy\SortingStrategyByRating;

class ProductsFacade
{
    public ArrayProductsDataProvider $productsDataProvider;
    public function __construct()
    {
        $this->productsDataProvider = new ArrayProductsDataProvider();
    }

    public function getProducts(): array
    {
        return $this->productsDataProvider->getProducts();
    }
    public function getSortedProducts(string $sortType): array
    {
        $products = $this->getProducts();
        $strategy = $this->getSortingStrategy($sortType);

        if ($strategy instanceof SortingStrategy) {
            return $strategy->sort($products);
        }

        return $products;
    }

    private function getSortingStrategy(string $sortType): ?SortingStrategy
    {
        return match ($sortType) {
            'name' => new SortingStrategyByName(),
            'price' => new SortingStrategyByPrice(),
            'rating' => new SortingStrategyByRating(),
            default => null,
        };
    }
}
