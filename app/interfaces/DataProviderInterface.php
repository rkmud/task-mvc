<?php

declare(strict_types=1);

namespace App\interfaces;

interface DataProviderInterface
{
    public function getById(int $id): ?array;
}
