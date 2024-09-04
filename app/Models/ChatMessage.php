<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'message','status','chat_id','user_id','admin_id','other_user_id'
    ];
    public function chat(){
        return $this->belongsTo(Chat::class,'chat_id');
    }  
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }  
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }  
    public function member(){
        return $this->belongsTo(User::class,'other_user_id');
    }  
}
