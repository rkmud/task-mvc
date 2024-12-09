<?php

declare(strict_types=1);

namespace Tests\Controller;

use PHPUnit\Framework\TestCase;
use App\Controllers\SearchController;
use App\Services\CacheService;

class SearchControllerTest extends TestCase
{
    private SearchController $controller;
    private CacheService $cacheServiceMock;

    protected function setUp(): void
    {
        $this->cacheServiceMock = $this->createMock(CacheService::class);

        $this->controller = new SearchController();
        $this->controller->searchService = $this->cacheServiceMock;
    }

    public function testClearCache(): void
    {
        $this->cacheServiceMock->expects($this->once())
            ->method('clearCache');

        $_POST['delete_cache'] = true;

        ob_start();
        $this->controller->index();
        $output = ob_get_clean();

        $this->assertStringContainsString('Cache cleared!', $output);
    }
}
