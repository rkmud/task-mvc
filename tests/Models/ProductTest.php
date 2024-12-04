<?php

declare(strict_types=1);

namespace Tests\Models;

use App\models\Product;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    private Product $product;
    public function testProductConstructor(): void
    {
        $product = new Product(1, 'Product 1', 10.00);

        $this->assertSame(1, $product->id);
        $this->assertSame('Product 1', $product->name);
        $this->assertSame(10.00, $product->price);
    }

    public function testGetPriceWithDiscount(): void
    {
        $product = new Product(1, 'Product 1', 10.00);

        $discountedPrice = $product->getPriceWithDiscount(0.20);
        $this->assertSame(8.00, $discountedPrice);

        $discountedPrice = $product->getPriceWithDiscount(0.10);
        $this->assertSame(9.00, $discountedPrice);
    }
}
