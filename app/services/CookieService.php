<?php

declare(strict_types=1);

namespace App\services;

use App\interfaces\CookieServiceInterface;

class CookieService implements CookieServiceInterface
{
    public static function setCookie(string $name, string $value, int $time): bool
    {
        if ($name === '' || $value === '' || $time <= 0) {
            return false;
        }

        return setcookie($name, $value, time() + $time, "/");
    }

    public static function deleteCookie(string $name): bool
    {
        return setcookie($name, "", time() - 3600, "/");
    }

    public static function getCookies(): array
    {
        return $_COOKIE;
    }
}
