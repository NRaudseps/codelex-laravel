<?php

namespace Tests\Feature;

use App\Models\Delivery;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductFeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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
        Product::factory()->create(['size' => 'XL']);
        $validDelivery = Delivery::factory()->create(['size' => 'XL']);
        $invalidDelivery = Delivery::factory()->create(['size' => 'S']);

        $response = $this->get('/products');

        $response->assertSee($validDelivery->name);
        $response->assertDontSee($invalidDelivery->name);
    }

    /** @test */
    public function a_user_can_see_multiple_product_delivery_choices()
    {
        Product::factory()->create(['size' => 'XL']);
        $deliveries = Delivery::factory()->count(2)->create(['size' => 'XL']);

        $response = $this->get('/products');

        $response->assertSee($deliveries[0]->name);
        $response->assertSee($deliveries[1]->name);
    }

    /** @test */
    public function a_user_can_see_one_product()
    {
        $product = Product::factory()->create();

        $response = $this->get($product->path());

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    /** @test */
    public function a_user_can_add_another_product()
    {
        $this->get('/products/create')->assertStatus(200);

        $info = [
            'name' => $this->faker->word,
            'size' => $this->faker->word,
            'price' => $this->faker->randomFloat(),
            'category' => $this->faker->word,
        ];

        $this->post('/products', $info)->assertRedirect('/products');

        $this->get('/products')->assertSee($info['name']);
    }

    /** @test */
    public function a_user_can_edit_a_product()
    {
        $product = Product::factory()->create();
        $this->get($product->path() . '/edit')->assertStatus(200);

        $info = [
            'name' => $this->faker->word,
            'size' => $this->faker->word,
            'price' => $this->faker->randomFloat(),
            'category' => $this->faker->word,
        ];

        $this->put($product->path(), $info)->assertRedirect($product->path());
        $this->get($product->path())->assertSee($info['name']);
        $this->get($product->path())->assertDontSee($product->name);
    }

    /** @test */
    public function a_user_can_delete_a_product()
    {
        $this->withoutExceptionHandling();
        $product = Product::factory()->create();

        $response = $this->delete($product->path())->assertRedirect('/products');

        $this->get('/products')->assertDontSee($product->name);
    }
}
