<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_values', 'product_id', 'attribute_id')
                    ->withPivot('id','value');
    }

    public function rentalPeriods()
    {
        return $this->belongsToMany(RentalPeriod::class, 'product_rental_period');
    }

    public function pricing()
    {
        return $this->hasMany(ProductPricing::class);
    }
}

