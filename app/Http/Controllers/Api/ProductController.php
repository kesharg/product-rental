<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{



    public function show(ProductRequest $request, $id)
    {
        try {

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


            // Return the cached product data without timestamps
            return new ProductResource($product); // Use $product['data'] to exclude timestamps
        } catch (ValidationException $e) {
            // Handle validation exception
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }
}
