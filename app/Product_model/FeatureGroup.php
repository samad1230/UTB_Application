<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class FeatureGroup extends Model
{
    protected $fillable = [
        'product_id','group_name'
    ];

    public function product(){
        return $this->belongsTo('App\Admin_model\Product');
    }

    public function features(){
        return $this->hasMany('App\Product_model\FeatureProduct');
    }

}
