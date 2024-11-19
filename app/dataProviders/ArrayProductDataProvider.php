<?php

declare(strict_types=1);

namespace App\dataProviders;

use App\Interfaces\DataProviderInterface;

final class ArrayProductDataProvider implements DataProviderInterface
{
    private array $data;

    public function __construct()
    {
        $this->data = [
            1 => ['id' => 1, 'name' => 'Product 1', 'price' => 10.00],
            2 => ['id' => 2, 'name' => 'Product 2', 'price' => 20.00],
            3 => ['id' => 3, 'name' => 'Product 3', 'price' => 30.00],
        ];
    }

    public function getById(int $id): ?array
    {
        if ( ! array_key_exists($id, $this->data)) {
            return null;
        }

        return $this->data[$id];
    }
}
