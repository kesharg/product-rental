<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RentalPeriod;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentalPeriod>
 */
class RentalPeriodFactory extends Factory
{
    protected $model = RentalPeriod::class;

    public function definition(): array
    {
        return [
            'duration' => $this->faker->randomElement(['1 day', '1 week', '1 month']),
        ];
    }
}
