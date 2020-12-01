<?php

namespace Tests\Unit;

use App\Models\Delivery;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_product_has_deliveries()
    {
        $product = Product::factory()->create(['size' => 'X']);
        $delivery = Delivery::factory()->create(['size' => 'X']);

        $this->assertEquals($delivery->name, $product->delivery->first()->name);
    }

    /** @test */
    public function a_product_has_a_path()
    {
        $product = Product::factory()->create();

        $this->assertEquals('/products/1', $product->path());
    }
}
