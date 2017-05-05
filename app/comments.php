<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    function post(){
        return $this->belongsTo('App\Post');

    }
    function user(){
        return $this->belongsTo('App\User');
    }

    function likes(){
        return $this->morphMany('App\User', 'likeable');
    }

}
