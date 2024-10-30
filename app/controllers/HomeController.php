<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Response\Response;

class HomeController
{
    private Response $response;

    public function __construct()
    {
        $this->response = new Response();
    }

    public function index(): void
    {
        $this->response->view('home', []);
    }
}