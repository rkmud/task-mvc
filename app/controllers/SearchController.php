<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\SearchService;
use App\Services\ProxySearchService;

class SearchController extends BaseController
{
    private ProxySearchService $proxySearchService;

    public function __construct()
    {
        $this->proxySearchService = new ProxySearchService(new SearchService);
        parent::__construct();
    }

    public function index(): void
    {
        if (isset($_POST['delete_cache'])) {
            $this->proxySearchService->clearCache();
            $this->view('search', ['message' => 'Cache cleared!', 'results' => []]);
            return;
        }
        $query = $_GET['value'] ?? '';
        $results = $this->proxySearchService->search($query);
        $this->view('search', ['results' => $results]);
    }
}
