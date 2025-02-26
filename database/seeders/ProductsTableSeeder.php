<?php
// database/seeders/ProductsTableSeeder.php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Seeding products
        Product::create([
            'name' => 'Product 1',
            'description' => 'This is product 1 description.',
            'sku' => 'SKU001'
        ]);

        Product::create([
            'name' => 'Product 2',
            'description' => 'This is product 2 description.',
            'sku' => 'SKU002'
        ]);
    }
}
