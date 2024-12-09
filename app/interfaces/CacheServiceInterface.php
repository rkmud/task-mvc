<?php

namespace App\interfaces;

interface CacheServiceInterface
{
    public function clearCache(): void;

    public function search(string $query): array;

    public function findPages(string $query): array;
}
