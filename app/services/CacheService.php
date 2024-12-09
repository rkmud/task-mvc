<?php

namespace App\Services;

use App\interfaces\CacheServiceInterface;
use Memcached;

class CacheService implements CacheServiceInterface
{
    protected Memcached $memcached;

    public function __construct(Memcached $memcached)
    {
        $this->memcached = $memcached;
    }

    public function clearCache(): void
    {
        $this->memcached->flush();
    }

    public function search(string $query): array
    {
        $cacheKey = md5($query);

        $results = $this->memcached->get($cacheKey);
        if (!$results) {
            $results = $this->findPages($query);
            $this->memcached->set($cacheKey, $results, 3600);
        }

        return $results;
    }

    public function findPages(string $query): array
    {
        $pages = [
            ['title' => 'Home Page', 'url' => '/'],
            ['title' => 'About Us', 'url' => '/about'],
            ['title' => 'Contact Us', 'url' => '/contact'],
            ['title' => 'Product 1', 'url' => '/product/1'],
            ['title' => 'Search', 'url' => '/search'],
        ];

        return array_filter($pages, function ($page) use ($query) {
            return stripos($page['title'], $query) !== false;
        });
    }
}
