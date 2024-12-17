<?php

namespace App\dataProviders;

class ArrayProductsDataProvider
{
    private array $products;

    public function __construct()
    {
        $this->products = [
            1 => ['id' => 1, 'name' => 'Product 1', 'price' => 10.00, 'rating'=> 5],
            2 => ['id' => 2, 'name' => 'Product 2', 'price' => 20.00, 'rating'=> 2],
            3 => ['id' => 3, 'name' => 'Product 3', 'price' => 30.00, 'rating'=> 1],
            4 => ['id' => 4, 'name' => 'Product 4', 'price' => 50.00, 'rating'=> 6],
            5 => ['id' => 5, 'name' => 'Product 41', 'price' => 13.00, 'rating'=> 3],
            6 => ['id' => 6, 'name' => 'Product 5', 'price' => 40.00, 'rating'=> 4]
        ];
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}
