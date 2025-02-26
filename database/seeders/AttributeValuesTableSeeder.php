<?php
// database/seeders/AttributeValuesTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeValuesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('attribute_values')->insert([
            ['attribute_id' => 1, 'product_id' => 1, 'value' => 'Red'],
            ['attribute_id' => 2, 'product_id' => 1, 'value' => 'Medium'],

            ['attribute_id' => 1, 'product_id' => 2, 'value' => 'Blue'],
            ['attribute_id' => 2, 'product_id' => 2, 'value' => 'Large'],

            ['attribute_id' => 1, 'product_id' => 1, 'value' => 'Green'],
            ['attribute_id' => 2, 'product_id' => 2, 'value' => 'Small'],
        ]);
    }

}
