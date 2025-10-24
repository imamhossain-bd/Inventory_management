<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variants extends Model
{
    protected $table = 'variants';

    protected $fillable = [
        'name',
        'type',
        'value',
        'product_id',
        'description',
        'status',
    ];

    protected $casts = [
        'value' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
