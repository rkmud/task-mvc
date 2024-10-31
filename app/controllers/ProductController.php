<?php

declare(strict_types=1);

namespace App\Controllers;

class ProductController extends BaseController
{
    public function show(string $id): void
    {
        $product = $this->getProductById((int) $id);

        if (!$product) {
            $this->view('error', ['message' => 'Product not found'], 404);
            return;
        }

        $this->view('product', ['product' => $product]);
    }

    private function getProductById(int $id): null|array
    {
        $products = [
            1 => ['id' => 1, 'name' => 'Product 1', 'price' => 10.00],
            2 => ['id' => 2, 'name' => 'Product 2', 'price' => 20.00],
            3 => ['id' => 3, 'name' => 'Product 3', 'price' => 30.00],
        ];

        return $products[$id] ?? null;
    }
}
