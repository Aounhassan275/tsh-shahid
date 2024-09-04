<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInstallment extends Model
{
    
    protected $fillable = [
        'price','product_id','monthly_amount','duration','user_id'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
