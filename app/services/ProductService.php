<?php

declare(strict_types=1);

namespace App\services;

use App\Repositories\ProductRepository;
use App\Models\Product;

final class ProductService
{
    public function __construct(private ProductRepository $repository) {}

    public function getProduct(int $id): ?Product
    {
        return $this->repository->getById($id);
    }
}
