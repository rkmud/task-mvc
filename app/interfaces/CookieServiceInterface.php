<?php

declare(strict_types=1);

namespace App\interfaces;

interface CookieServiceInterface
{
    public static function setCookie(string $name, string $value, int $time, string $path) : bool;

    public static function deleteCookie(string $name): bool;

    public static function getCookies(): array;
}
