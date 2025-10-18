<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Roles extends Model
{
    protected $fillable = ['name', 'label'];


    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }


}
