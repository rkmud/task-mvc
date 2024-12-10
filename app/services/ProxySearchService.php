<?php

namespace App\Services;

use App\Interfaces\SearchServiceInterface;
use Memcached;

class ProxySearchService implements SearchServiceInterface
{
    private Memcached $memcached;

    public function __construct(private readonly SearchService $searchService)
    {
        $this->memcached = new Memcached();
        $this->memcached->addServer('localhost', 11211);
    }

    public function search(string $query): array
    {
        $cacheKey = $this->getCacheKey($query);
        $cachedResult = $this->memcached->get($cacheKey);

        if ($cachedResult === false) {
            $cachedResult = $this->searchService->search($query);
            if (! $cachedResult) {
                return [];
            }
            $this->memcached->set($cacheKey, $cachedResult, 3600);
        }

        return $cachedResult;
    }

    public function clearCache(): void
    {
        $this->memcached->flush();
    }

    private function getCacheKey(string $query): string
    {
        return 'search_' . md5($query);
    }
}
