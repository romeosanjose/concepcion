<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';

    public function image(){
        return hasMany('App\Model\Files');
    }

}
