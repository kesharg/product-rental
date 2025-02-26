<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            ProductsTableSeeder::class,
            AttributesTableSeeder::class,
            AttributeValuesTableSeeder::class,
            RegionsTableSeeder::class,
            RentalPeriodsTableSeeder::class,
            ProductPricingTableSeeder::class,
        ]);
    }
}
