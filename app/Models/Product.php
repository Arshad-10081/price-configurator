<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'base_price'];

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
