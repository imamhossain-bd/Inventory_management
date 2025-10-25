<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpireProduct extends Model
{
    protected $table = 'expire_products';

    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'manufacturer_date',
        'expire_date',
        'images',
        'selling_price',
        'stock',
        'remarks',
    ];


    protected $casts = [
        'images' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
