<?php

declare(strict_types=1);

namespace App\Services;

use App\interfaces\SessionServiceInterface;

class SessionService implements SessionServiceInterface
{
    public static function setSession(string $value): void
    {
        $_SESSION['PHPSESSID'] = $value;
    }

    public static function getSession(): array
    {
        return isset($_SESSION['PHPSESSID']) ? ['PHPSESSID' => $_SESSION['PHPSESSID']] : [];
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
