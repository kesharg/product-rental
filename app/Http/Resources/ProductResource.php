<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ['id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'sku' => $this->sku,
                'attributes' => $this->productAttrubutes(),
                'pricing' => $this->productPricing()
            ];
    }

    public function productAttrubutes(){
            // Structure the attributes by attribute type

        $structuredAttributes = [];
        foreach ($this->attributes as $attribute) {
            if (!isset($structuredAttributes[$attribute->name])) {
                $structuredAttributes[$attribute->name] = [];
            }

            $structuredAttributes[$attribute->name][] = [
                'attribute_value_id' => $attribute->pivot ? $attribute->pivot->id : null,
                'name' => $attribute->name,
                'value' => $attribute->pivot ? $attribute->pivot->value : null
            ];
        }

        return $structuredAttributes;
    }

    public function productPricing(){
        // Structure the pricing details by region and rental periods
        $structuredPricing = [];
        foreach ($this->pricing as $price) {
            if (!isset($structuredPricing[$price->region->id])) {
                $structuredPricing[$price->region->id] = [
                    'region_id' => $price->region->id,
                    'region_name' => $price->region->name,
                    'rental_periods' => []
                ];
            }

            $structuredPricing[$price->region->id]['rental_periods'][] = [
                'rental_period_id' => $price->rentalPeriod->id,
                'rental_period_name' => $price->rentalPeriod->duration,

                'price' => (string) $price->price
            ];
        }

        return array_values($structuredPricing);
    }
}
