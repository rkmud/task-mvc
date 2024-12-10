<?php

declare(strict_types=1);

namespace Tests\Services;

use PHPUnit\Framework\TestCase;
use App\Services\CacheService;
use Memcached;

class CacheServiceTest extends TestCase
{
    private Memcached $memcachedMock;
    private CacheService $cacheService;

    protected function setUp(): void
    {
        $this->memcachedMock = $this->createMock(Memcached::class);
        $this->cacheService = new CacheService($this->memcachedMock);
    }

    public function testSearchWithResults(): void
    {
        $query = 'Search';
        $cacheKey = md5($query);
        $expectedResults = [
            ['title' => 'Search', 'url' => '/search'],
        ];

        $this->memcachedMock->expects($this->once())
            ->method('get')
            ->with($cacheKey)
            ->willReturn($expectedResults);

        $results = $this->cacheService->search($query);
        $this->assertEquals($expectedResults, $results);
    }

    public function testSearchNotFound(): void
    {
        $query = 'Nonexistent';
        $cacheKey = md5($query);

        $this->memcachedMock->expects($this->once())
            ->method('get')
            ->with($cacheKey)
            ->willReturn(false);

        $results = $this->cacheService->search($query);
        $this->assertEquals([], $results);
    }
}
