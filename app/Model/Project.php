<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';

     public function image(){
        return hasMany('Files');
    }
}
