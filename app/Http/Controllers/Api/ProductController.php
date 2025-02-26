<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{


    public function show(Request $request, $id)
    {
        try {
            // Validate query parameters (region_id and rental_period_id must be integers if provided)
            $validated = $request->validate([
                'region_id' => 'nullable|integer|exists:regions,id',
                'rental_period_id' => 'nullable|integer|exists:rental_periods,id',
            ]);

            // Check if product data is cached
            $cacheKey = "product_{$id}_region_{$request->region_id}_rental_{$request->rental_period_id}";
            $product = Cache::get($cacheKey);

            if (!$product) {
                // Product query eager loading related models
                $productQuery = Product::with(['attributes']);

                // Fetch the product to get a single record
                $product = $productQuery->find($id);

                // If product does not exist, return a 404 response
                if (!$product) {
                    return response()->json([
                        'message' => 'Product not found'
                    ], 404);
                }

                // Eager load pricing conditionally based on request filters
                if ($request->has('region_id') || $request->has('rental_period_id')) {
                    $product->load(['pricing' => function ($query) use ($request) {
                        if ($request->has('region_id')) {
                            $query->where('region_id', $request->region_id);
                        }

                        if ($request->has('rental_period_id')) {
                            $query->where('rental_period_id', $request->rental_period_id);
                        }

                        // Eager load related region and rental period data
                        $query->with(['region', 'rentalPeriod']);
                    }]);
                } else {
                    $product->load(['pricing' => function ($query) {
                        $query->with(['region', 'rentalPeriod']);
                    }]);
                }

                // Structure the attributes by attribute type
                $structuredAttributes = [];
                foreach ($product->attributes as $attribute) {
                    if (!isset($structuredAttributes[$attribute->name])) {
                        $structuredAttributes[$attribute->name] = [];
                    }

                    $structuredAttributes[$attribute->name][] = [
                        'attribute_value_id' => $attribute->pivot ? $attribute->pivot->id : null,
                        'name' => $attribute->name,
                        'value' => $attribute->pivot ? $attribute->pivot->value : null
                    ];
                }

                // Structure the pricing details by region and rental periods
                $structuredPricing = [];
                foreach ($product->pricing as $price) {
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

                $structuredPricing = array_values($structuredPricing);

                // Cache only the relevant product data (excluding timestamps)
                Cache::put($cacheKey, [
                    'data' => [
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'sku' => $product->sku,
                        'attributes' => $structuredAttributes,
                        'pricing' => $structuredPricing
                    ],
                    'message' => 'Product data retrieved successfully'
                ], now()->addHour());
            }

            // Return the cached product data without timestamps
            return response()->json($product['data'], 200); // Use $product['data'] to exclude timestamps
        } catch (ValidationException $e) {
            // Handle validation exception
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }
}
