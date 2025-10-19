<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'sku', 'description', 'barcode', 'purchase_price', 'selling_price', 'discount_price', 'stock', 'stock_alert',
        'thumbnail', 'images', 'status', 'warranty_id', 'category_id', 'brand_id', 'supplier_id', 'unit_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function variants()
    {
        return $this->hasMany(Variants::class);
    }

    public function warranty()
    {
        return $this->belongsTo(Warranty::class, 'warranty_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function brand(){
        return $this->belongsTo(Brands::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function unit(){
        return $this->belongsTo(Units::class);
    }

}
