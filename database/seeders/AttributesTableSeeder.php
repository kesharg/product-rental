<?php
// database/seeders/AttributesTableSeeder.php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributesTableSeeder extends Seeder
{
    public function run()
    {
        // Seeding product attributes
        Attribute::create([
            'name' => 'Color'
        ]);

        Attribute::create([
            'name' => 'Size'
        ]);
    }
}
