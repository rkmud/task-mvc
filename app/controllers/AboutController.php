<?php

declare(strict_types=1);

namespace App\Controllers;

class AboutController extends BaseController
{
    public function index(): void
    {
        $this->view('about');
    }
}
