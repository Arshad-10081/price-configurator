<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['product_id', 'type', 'option', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}