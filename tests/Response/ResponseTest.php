<?php

declare(strict_types=1);

namespace Tests\Response;

use App\Response\Response;
use Mockery;
use PHPUnit\Framework\TestCase;

final class ResponseTest extends TestCase
{
    private Response $response;
    protected function setUp(): void
    {
        $this->response = Mockery::mock(Response::class)->makePartial();
    }

    /**
         * @test
         * @dataProvider getRoute
    **/
    public function testViewNotFound(string $view)
    {
        $this->response = Mockery::mock(Response::class)->makePartial();

        $this->response ->shouldReceive('fileExists')->once()
            ->with(sprintf('app/views/%sView.php', $view))
            ->andReturn(false);

        $this->response ->view($view);

        $this->expectOutputString('Not found');
    }

    public function testHomeView()
    {
        $this->response = Mockery::mock(Response::class)->makePartial();

        $this->response ->shouldReceive('fileExists')->once()
            ->with('app/views/homeView.php')
            ->andReturn(true);

        ob_start();
        $this->response->view('home');
        $output = ob_get_clean();

        $cleanedOutput = strip_tags($output);
        $cleanedOutput = preg_replace('/\s+/', ' ', $cleanedOutput);
        $cleanedOutput = trim($cleanedOutput);

        $this->assertEquals('This is home page', $cleanedOutput);
    }

    public static function getRoute(): array
    {
        return [
            ['qwerty'],
            ['contact/q'],
        ];
    }
}
