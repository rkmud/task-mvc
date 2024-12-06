<?php

declare(strict_types=1);

namespace Tests\Services;

use PHPUnit\Framework\TestCase;
use App\Services\SessionService;

class SessionServiceTest extends TestCase
{
    protected function setUp(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION = [];
        $_COOKIE = [];
    }

    public function testSetSession(): void
    {
        $mockSessionValue = 'test_session';

        SessionService::setSession($mockSessionValue);

        $this->assertArrayHasKey('PHPSESSID', $_SESSION);
        $this->assertEquals($mockSessionValue, $_SESSION['PHPSESSID']);
    }

    public function testGetSessionWithValidSession(): void
    {
        $mockSessionValue = 'test_session';

        $_SESSION['PHPSESSID'] = $mockSessionValue;

        $result = SessionService::getSession();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('PHPSESSID', $result);
        $this->assertEquals($mockSessionValue, $result['PHPSESSID']);
    }

    public function testGetSessionWithoutValidSession(): void
    {
        $result = SessionService::getSession();

        $this->assertEmpty($result);
    }

    public function testDestroySession(): void
    {
        $_SESSION['PHPSESSID'] = 'test_session';
        $_COOKIE[session_name()] = 'test_session_cookie';

        SessionService::destroySession();

        $this->assertEmpty($_SESSION);
    }

    protected function tearDown(): void
    {
        session_destroy();
        $_SESSION = [];
    }
}
