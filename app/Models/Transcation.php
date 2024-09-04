<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transcation extends Model
{
    protected $fillable = [
        'wallet',
        'amount',
        'user_id',
    ];
}
