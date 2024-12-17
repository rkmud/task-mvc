<?php

declare(strict_types=1);

namespace App\Services;

use App\interfaces\SearchServiceInterface;

class SearchService implements SearchServiceInterface
{
    public function search(string $query): array
    {
        return $this->findPages($query);
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
