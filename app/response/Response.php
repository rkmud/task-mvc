<?php

declare(strict_types=1);

namespace App\Response;

class Response
{
    public function view(string $view, array $data = [], int $status = 200): void
    {
        http_response_code($status);

        $views_path = sprintf('app/views/%sView.php', $view);

        if (!$this->fileExists($views_path)) {
            echo 'Not found';

            return;
        }

        if (!empty($data)) {
            extract($data, EXTR_PREFIX_SAME, 'data_');
        }

        require_once $views_path;
    }

    public function fileExists(string $path): bool
    {
        return file_exists($path);
    }
}
