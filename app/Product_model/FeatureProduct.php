<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class FeatureProduct extends Model
{
    protected $fillable = [
        'feature_name','material','product_id'
    ];

    public function product(){
        return $this->belongsTo('App\Admin_model\Product');
    }
}
