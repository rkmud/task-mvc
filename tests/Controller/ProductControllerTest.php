<?php

declare(strict_types=1);

namespace Tests\Controller;

use App\Controllers\ProductController;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class ProductControllerTest extends TestCase
{
    private MockObject $mock;
    protected function setUp(): void
    {
        $this->mock = $this->getMockBuilder(ProductController::class)
            ->onlyMethods(['view', 'getProductById'])
            ->getMock();
    }

    public function testShowWithExitingId(): void
    {
        $product = ['id' => 1, 'name' => 'Product 1', 'price' => 10.00];

        $this->mock->expects($this->once())
            ->method('getProductById')
            ->with(1)
            ->willReturn($product);

        $this->mock->expects($this->once())
            ->method('view')
            ->with('product', ['product' => $product]);

        $this->mock->show('1');
    }

    public function testShowWithNonExistingId(): void
    {
        $this->mock->expects($this->once())
            ->method('getProductById')
            ->with(10)
            ->willReturn(null);

        $this->mock->expects($this->once())
            ->method('view')
            ->with('error', ['message' => 'Product not found'], 404);

        $this->mock->show('10');
    }
}
