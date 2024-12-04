<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DataProviders\ArrayProductDataProvider;
use App\repositories\ProductRepository;
final class ProductController extends BaseController
{
    private ArrayProductDataProvider $dataProvider;

    public function __construct() {
        parent::__construct();
        $this->dataProvider = new ArrayProductDataProvider();
    }

    public function show(string $id): void
    {
        $product = (new ProductRepository($this->dataProvider))->getByid(intval($id));

        if (!$product) {
            $this->view('error', ['message' => 'Product not found'], 404);
            return;
        }

        $this->view('product', ['product' => $product]);
    }
}
