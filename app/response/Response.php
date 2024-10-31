<?php

declare(strict_types=1);

namespace App\Response;

class Response
{
    public function view(string $view, array $data = [], int $status = 200): void
    {
        $views_path = sprintf('app/views/%sView.php', $view);

        if (!file_exists($views_path)) {
            echo 'Not found';
            return;
        }

        if ($data != []) {
            extract($data, EXTR_PREFIX_SAME, 'data_');
        }

        require_once $views_path;
    }
}
