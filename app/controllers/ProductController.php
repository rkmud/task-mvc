<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Response\Response;

class ProductController
{
    private Response $response;

    public function show($id): void
    {
        $product = $this->getProductById($id);
        $this->response = new Response();
        if ($product) {
            $this->response->view('product', ['product' => $product]);

        } else {
            $this->response->view('error',['message' => 'Product not found'], 404);
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
