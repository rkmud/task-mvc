<?php

declare(strict_types=1);

namespace App\interfaces;

interface SessionServiceInterface
{
    public static function setSession(string $value): void;

    public static function getSession(): array;

    public static function destroySession(): void;
}
