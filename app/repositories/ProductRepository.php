<?php

declare(strict_types=1);

namespace App\repositories;

use App\Interfaces\DataProviderInterface;
use App\Models\Product;

final class ProductRepository
{
    public function __construct(private readonly DataProviderInterface $dataProvider) {}

    public function getById(int $id): ?Product
    {
        $productData = $this->dataProvider->getById($id);

        if ($productData === null) {
            return null;
        }

        return new Product($productData['id'], $productData['name'], $productData['price']);
    }
}
