<?php

namespace App\Recognition_model;

use Illuminate\Database\Eloquent\Model;

class Purchase_Type extends Model
{
    protected $fillable=[
        'purchase_type'
    ];

    public function warehouse(){
        return $this->hasOne('App\Product_model\Warehouse');
    }
}
