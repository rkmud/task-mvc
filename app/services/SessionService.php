<?php

declare(strict_types=1);

namespace App\Services;

use App\interfaces\SessionServiceInterface;

class SessionService implements SessionServiceInterface
{
    public static function setSession(string $key,string $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function getSession(): array
    {
        return $_SESSION;
    }

    public static function deleteSessionKey(string $key): void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    public static function destroySession(): void
    {
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        session_destroy();
        $_SESSION = [];
    }
}
