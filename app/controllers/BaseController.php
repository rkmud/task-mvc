<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Response\Response;

class BaseController
{
    public Response $response;

    public function __construct()
    {
        $this->response = new Response();
    }

    public function view(string $view, array $data = [], int $status = 200): void
    {
        $this->response->view($view, $data, $status);
    }
}
