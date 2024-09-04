<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    
    protected $fillable = [
        'admin_id','user_id','other_user_id'
    ];
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }  
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }  
    public function member(){
        return $this->belongsTo(User::class,'other_user_id');
    }  
    public function messages()
    {
        return $this->hasMany(ChatMessage::class,'chat_id');
    }
}
