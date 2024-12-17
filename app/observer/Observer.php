<?php

declare(strict_types=1);

namespace App\observer;

interface Observer
{
    public function update(string $event, array $data): void;
}
