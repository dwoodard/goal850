<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'stripe_product_id',
        'stripe_price_id',
        'array_products',
    ];

    protected $casts = [
        'array_products' => 'array',
    ];
}
