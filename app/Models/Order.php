<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id','price','address','name','user_id','status','delivery_cost','quantity',
        'order_type','is_stock','phone','coupon_id','discount_amount','coupon_code'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
