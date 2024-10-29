<?php

declare(strict_types=1);

namespace App\Controllers;

class ProductController
{
    public function show($id): void
    {

        $product = $this->getProductById($id);

        if ($product)
        {
            echo "Product ID: " . $product['id'] . "<br>";
            echo "Product Name: " . $product['name'] . "<br>";
            echo "Product Price: $" . $product['price'] . "<br>";
        } else
        {
            echo "Product not found!";
        }
    }

    private function getProductById($id): null|array
    {
        $products = [
            1 => ['id' => 1, 'name' => 'Product 1', 'price' => 10.00],
            2 => ['id' => 2, 'name' => 'Product 2', 'price' => 20.00],
            3 => ['id' => 3, 'name' => 'Product 3', 'price' => 30.00],
        ];

        return $products[$id] ?? null;
    }
}
