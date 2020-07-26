<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class friend extends Model
{
    protected $hidden = ['created_at','updated_at'];
    public function user()
    {
       return $this->belongsTo(User::class,'friend_id')->select('id','name')->orderBy('id','desc');
    }
}
