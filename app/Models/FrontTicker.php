<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontTicker extends Model
{
    protected $fillable = [
        'title','message'
    ];
}
