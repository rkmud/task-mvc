<?php

declare(strict_types=1);

namespace Tests\Services;

use PHPUnit\Framework\TestCase;
use App\services\CookieService;

class CookieServiceTest extends TestCase
{
    protected function setUp(): void
    {
        $_COOKIE = [];
    }

    public function testSetCookieValid(): void
    {
        $mockCookieName = 'test_cookie';
        $mockCookieValue = 'test_value';
        $mockCookieTime = 3600;

        $_COOKIE[$mockCookieName] = $mockCookieValue;

        $res = CookieService::setCookie($mockCookieName, $mockCookieValue, $mockCookieTime);

        $this->assertTrue($res);
        $this->assertEquals($mockCookieValue, $_COOKIE[$mockCookieName]);

        unset($_COOKIE[$mockCookieName]);
    }


    public function testSetCookieInvalid(): void
    {
        $result = CookieService::setCookie('', 'value', 3600);
        $this->assertFalse($result);
    }

    public function testDeleteCookieExists(): void
    {
        $cookieName = 'delete_cookie';
        $_COOKIE[$cookieName] = 'some_value';

        $result = CookieService::deleteCookie($cookieName);

        $this->assertTrue($result);
    }

    public function testDeleteCookieNotExists(): void
    {
        $cookieName = 'some_cookie';

        $result = CookieService::deleteCookie($cookieName);

        $this->assertFalse($result);
    }

    public function testGetCookies(): void
    {
        $_COOKIE = [
            'cookie1' => 'value1',
            'cookie2' => 'value2',
        ];

        $cookies = CookieService::getCookies();

        $this->assertIsArray($cookies);
        $this->assertCount(2, $cookies);
        $this->assertArrayHasKey('cookie1', $cookies);
        $this->assertArrayHasKey('cookie2', $cookies);
        $this->assertEquals('value1', $cookies['cookie1']);
        $this->assertEquals('value2', $cookies['cookie2']);
    }
}
