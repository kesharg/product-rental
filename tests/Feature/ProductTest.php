<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductPricing;
use App\Models\Region;
use App\Models\RentalPeriod;

class ProductTest extends TestCase
{
    use RefreshDatabase; // Ensures database is reset after each test

    /** @test */
    public function it_can_create_a_product()
    {
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'sku' => 'TEST123',
            'description' => 'This is a test product.',
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'sku' => 'TEST123',
        ]);
    }

    /** @test */
    public function it_can_have_attributes()
    {
        $product = Product::factory()->create();
        $attribute = Attribute::factory()->create(['name' => 'Color']);
        $attributeValue = AttributeValue::factory()->create([
            'product_id' => $product->id,
            'attribute_id' => $attribute->id,
            'value' => 'Blue',
        ]);

        $this->assertDatabaseHas('attribute_values', [
            'product_id' => $product->id,
            'attribute_id' => $attribute->id,
            'value' => 'Blue',
        ]);
    }

    /** @test */
    public function it_can_have_pricing_for_different_regions_and_rental_periods()
    {
        $product = Product::factory()->create();
        $region = Region::factory()->create(['name' => 'Singapore']);
        $rentalPeriod = RentalPeriod::factory()->create(['duration' => '1 Month']);

        $pricing = ProductPricing::factory()->create([
            'product_id' => $product->id,
            'region_id' => $region->id,
            'rental_period_id' => $rentalPeriod->id,
            'price' => 100.00,
        ]);

        $this->assertDatabaseHas('product_pricings', [
            'product_id' => $product->id,
            'region_id' => $region->id,
            'rental_period_id' => $rentalPeriod->id,
            'price' => 100.00,
        ]);
    }
}
