<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductPricing;
use App\Models\Product;
use App\Models\Region;
use App\Models\RentalPeriod;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductPricing>
 */
class ProductPricingFactory extends Factory
{
    protected $model = ProductPricing::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'region_id' => Region::factory(),
            'rental_period_id' => RentalPeriod::factory(),
            'price' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
