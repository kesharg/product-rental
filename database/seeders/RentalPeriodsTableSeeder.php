<?php
// database/seeders/RentalPeriodsTableSeeder.php

namespace Database\Seeders;

use App\Models\RentalPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalPeriodsTableSeeder extends Seeder
{
    public function run()
    {
        // Seeding rental periods
        RentalPeriod::create([
            'duration' => '3 months'
        ]);

        RentalPeriod::create([
            'duration' => '6 months'
        ]);

        RentalPeriod::create([
            'duration' => '12 months'
        ]);
    }
}
