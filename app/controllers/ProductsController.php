<?php

declare(strict_types=1);

namespace App\controllers;

use App\facade\ProductsFacade;

class ProductsController extends BaseController
{
    private ProductsFacade $productsFacade;
    public function __construct()
    {
        $this->productsFacade = new ProductsFacade();
        parent::__construct();
    }

    public function index(): void
    {
        $sortType = $_POST['action'] ?? '';
        $products = $this->productsFacade->getSortedProducts($sortType);
        $this->view('products', ['products' => $products] );
    }
}
