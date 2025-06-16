<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountRule extends Model
{
    protected $fillable = ['type', 'condition', 'discount_type', 'value'];

    protected $casts = [
        'condition' => 'array'
    ];

    public function setConditionAttribute($value)
    {
        $this->attributes['condition'] = is_array($value) 
            ? json_encode($value) 
            : $value;
    }

    public function getConditionAttribute($value)
    {
        return json_decode($value, true);
    }
}
