<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPricing extends Model
{
    use HasFactory;

    protected $table = 'product_pricings'; // Explicitly define the table name

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); // specify custom foreign key
    }

    public function rentalPeriod()
    {
        return $this->belongsTo(RentalPeriod::class, 'rental_period_id'); // specify custom foreign key
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id'); // specify custom foreign key
    }
}
