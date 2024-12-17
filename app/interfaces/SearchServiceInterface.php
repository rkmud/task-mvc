<?php

declare(strict_types=1);

namespace App\interfaces;

interface SearchServiceInterface
{
    public function search(string $query): array;
}

