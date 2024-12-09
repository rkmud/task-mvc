<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\CacheService;
use Memcached;

class SearchController extends BaseController
{
    public CacheService $searchService;
    private Memcached $memcache;
    public array $data;

    public function __construct()
    {
        $this->memcache = new Memcached();
        $this->memcache->addServer('localhost', 11211);
        $this->searchService = new CacheService($this->memcache);

        parent::__construct();
    }

    public function index(): void
    {
        $data = $this->handleRequest();
        $this->view('search', $data);
    }

    private function handleRequest(): array
    {
        $data = [];

        if (isset($_GET['search'])) {
            $query = $_GET['value'] ?? '';
            $results = $this->searchService->search($query);

            if (empty($results)) {
                $data['message'] = 'Not found';
            } else {
                $data['results'] = $results;
            }
        }
        elseif (isset($_POST['delete_cache'])) {
            $this->searchService->clearCache();
            $data['message'] = 'Cache cleared!';
        }

        return $data;
    }
}
