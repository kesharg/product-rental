<?php
// database/seeders/RegionsTableSeeder.php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
{
    public function run()
    {
        // Seeding regions
        Region::create([
            'name' => 'Singapore'
        ]);

        Region::create([
            'name' => 'Malaysia'
        ]);
    }
}
