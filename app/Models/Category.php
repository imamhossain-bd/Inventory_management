<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';

    protected $fillable = ['cat_name', 'cat_slug', 'category_code', 'cat_description'];


    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
