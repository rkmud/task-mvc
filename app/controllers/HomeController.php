<?php

declare(strict_types=1);

namespace App\Controllers;

use App\services\CookieService;
use App\services\SessionService;

class HomeController extends BaseController
{
    public function index(): void
    {
        session_start();

        $action = $_POST['action'] ?? ($_GET['action'] ?? null);

        if ($action) {
            $this->handleAction($action);
        } elseif (isset($_GET['delete_cookie'])) {
            $this->deleteCookie($_GET['delete_cookie']);
        } elseif (isset($_GET['delete_session'])) {
            $this->deleteSession();
        } elseif (isset($_GET['delete_session_key'])) {
            $this->deleteSessionKey();
        }

        $this->render();
    }

    private function handleAction(string $action): void
    {
        switch ($action) {
            case 'create_cookie':
                $this->createCookie();
                break;

            case 'create_session':
                $this->createSession();
                break;
        }
    }

    private function createCookie(): void
    {
        $name = $_POST['cookie_name'] ?? '';
        $value = $_POST['cookie_value'] ?? '';
        $time = (int) ($_POST['cookie_time'] ?? 0);

        if ($name && $value && $time > 0) {
            CookieService::setCookie($name, $value, $time);
        }

        header('Location: /');
        exit;
    }

    private function deleteCookie(): void
    {
        $name = $_GET['delete_cookie'] ?? '';
        if ($name) {
            CookieService::deleteCookie($name);
        }

        header('Location: /');
        exit;
    }

    private function createSession(): void
    {
        $key = $_POST['session_key'] ?? '';
        $value = $_POST['session_value'] ?? '';
        if ($key && $value) {
            SessionService::setSession($key, $value);
        }

        header('Location: /');
        exit;
    }
    private function deleteSessionKey(): void
    {
        $key = $_GET['delete_session_key'] ?? '';
        if ($key) {
            SessionService::deleteSessionKey($key);
        }

        header('Location: /');
        exit;
    }
    private function deleteSession(): void
    {
        SessionService::destroySession();
        header('Location: /');
        exit;
    }

    private function render(): void
    {
        $cookies = CookieService::getCookies();
        $sessions = SessionService::getSession();
        $this->view('home', ['cookies' => $cookies, 'sessions' => $sessions]);
    }
}
