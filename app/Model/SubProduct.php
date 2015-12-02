<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model
{
    protected $table = 'sub_product';

    public function materials(){
        return $this->hasMany('App\Model\SubProductMaterial');
    }
}
