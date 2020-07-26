<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Message extends Model
{

    protected $hidden = ['created_at','updated_at'];
    public function scopeByUser($query,$user_id)
    {
        return $query->where([
            'from' => $user_id,
            'to' => Auth::User()->id,
        ])->orWhere(
            'from' , Auth::User()->id,
        )->where('to',$user_id)->orderBy('id','asc');
    }
}
