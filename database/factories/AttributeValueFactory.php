<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AttributeValue;
use App\Models\Attribute;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttributeValue>
 */
class AttributeValueFactory extends Factory
{
    protected $model = AttributeValue::class;

    public function definition(): array
    {
        $attribute = Attribute::inRandomOrder()->first() ?? Attribute::factory()->create();

        $values = [
            'Color' => ['Blue', 'Green', 'Red'],
            'Size' => ['Large', 'Medium', 'Small'],
        ];

        return [
            'attribute_id' => $attribute->id,
            'product_id' => Product::factory(),
            'value' => $this->faker->randomElement($values[$attribute->name] ?? ['Default']),
        ];
    }
}
