<?php

namespace Tests\Feature;

use App\Models\Delivery;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_see_all_products()
    {
        $product = Product::factory()->create();

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($product->size);
        $response->assertSee(number_format((float) $product->price/100, 2, '.', "'") . '$');
        $response->assertSee($product->category);
    }

    /** @test */
    public function a_user_can_see_product_delivery_choices()
    {
        $product = Product::factory()->create(['size' => 'XL']);
        $validDelivery = Delivery::factory()->create(['size' => 'XL']);
        $invalidDelivery = Delivery::factory()->create(['size' => 'S']);

        $response = $this->get('/products');

        $response->assertSee($validDelivery->name);
        $response->assertDontSee($invalidDelivery->name);
    }

    /** @test */
    public function a_user_can_see_multiple_product_delivery_choices()
    {
        $product = Product::factory()->create(['size' => 'XL']);
        $deliveries = Delivery::factory()->count(2)->create(['size' => 'XL']);

        $response = $this->get('/products');

        $response->assertSee($deliveries[0]->name);
        $response->assertSee($deliveries[1]->name);
    }
}
