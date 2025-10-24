<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $table = 'products';


    protected $fillable = [
        'name', 'slug', 'sku', 'barcode', 'stock', 'stock_alert', 'warranty_id', 'category_id', 'sub_category_id', 'brand_id', 'unit_id', 'variants_id', 'duration',
        'description', 'purchase_price', 'selling_price', 'discount_price', 'tax_type', 'tax_amount', 'total_amount', 'images', 'manufacturer', 'manufacturer_date',
        'expire_date', 'status'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function variants()
    {
        return $this->hasMany(Variants::class, 'variants_id');
    }

    public function warranty()
    {
        return $this->belongsTo(Warranty::class, 'warranty_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function brand(){
        return $this->belongsTo(Brands::class, 'brand_id');
    }
    public function subCategory(){
        return $this->belongsTo(SubCategories::class, 'sub_category_id');
    }
    public function unit(){
        return $this->belongsTo(Units::class, 'unit_id');
    }

}
