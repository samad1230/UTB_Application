<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class FeatureProduct extends Model
{
    protected $fillable = [
        'feature_name','material','feature_group_id'
    ];

    public function featuregroup(){
        return $this->belongsTo('App\Product_model\FeatureGroup');
    }
}
