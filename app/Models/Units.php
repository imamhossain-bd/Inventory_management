<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    protected $table = 'units';


    protected $fillable = [
        'name',
        'short_name',
        'no_of_product',
        'status',
    ];


    public function products()
    {
        return $this->hasMany(Product::class, 'unit_id');
    }

}
