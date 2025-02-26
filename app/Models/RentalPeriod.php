<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalPeriod extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_rental_period');
    }

    public function pricing()
    {
        return $this->hasMany(ProductPricing::class);
    }
}

