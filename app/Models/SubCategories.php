<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{

    protected $table = 'sub_categories';

    protected $fillable = [
        'category_id',
        'category_code',
        'name',
        'slug',
        'description',
        'image',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
