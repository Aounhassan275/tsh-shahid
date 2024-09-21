<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'name','code','percentage','user_id'
    ];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
