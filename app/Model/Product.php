<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    public function materials(){
        return $this->hasMany('App\Model\ProductMaterial');
    }

    public function sub_products(){
        return $this->hasMany('App\Model\MainSubProduct');
    }
}
