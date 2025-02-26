<?php

// database/seeders/ProductPricingTableSeeder.php

namespace Database\Seeders;

use App\Models\ProductPricing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPricingTableSeeder extends Seeder
{
    public function run()
    {
        // Seeding product pricing for product 1
        ProductPricing::create([
            'product_id' => 1,
            'region_id' => 1,
            'rental_period_id' => 1,
            'price' => 10.99
        ]);

        ProductPricing::create([
            'product_id' => 1,
            'region_id' => 1,
            'rental_period_id' => 2,
            'price' => 15.99
        ]);

        ProductPricing::create([
            'product_id' => 1,
            'region_id' => 1,
            'rental_period_id' => 3,
            'price' => 20.99
        ]);

        ProductPricing::create([
            'product_id' => 1,
            'region_id' => 2,
            'rental_period_id' => 1,
            'price' => 12.99
        ]);

        ProductPricing::create([
            'product_id' => 1,
            'region_id' => 2,
            'rental_period_id' => 2,
            'price' => 17.99
        ]);

        ProductPricing::create([
            'product_id' => 1,
            'region_id' => 2,
            'rental_period_id' => 3,
            'price' => 22.99
        ]);

        // Seeding product pricing for product 2
        ProductPricing::create([
            'product_id' => 2,
            'region_id' => 1,
            'rental_period_id' => 1,
            'price' => 14.99
        ]);

        ProductPricing::create([
            'product_id' => 2,
            'region_id' => 1,
            'rental_period_id' => 2,
            'price' => 19.99
        ]);

        ProductPricing::create([
            'product_id' => 2,
            'region_id' => 1,
            'rental_period_id' => 3,
            'price' => 24.99
        ]);

        ProductPricing::create([
            'product_id' => 2,
            'region_id' => 2,
            'rental_period_id' => 1,
            'price' => 16.99
        ]);

        ProductPricing::create([
            'product_id' => 2,
            'region_id' => 2,
            'rental_period_id' => 2,
            'price' => 21.99
        ]);

        ProductPricing::create([
            'product_id' => 2,
            'region_id' => 2,
            'rental_period_id' => 3,
            'price' => 26.99
        ]);
    }

}
