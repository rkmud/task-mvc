<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Response\Response;

class ContactController
{
    private Response $response;

    public function __construct()
    {
        $this->response = new Response();
    }

    function index(): void
    {
        $this->response->view('contact', []);
    }
}
