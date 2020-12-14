<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class ProductVideo extends Model
{
    protected $fillable = [
        'video_name','product_id'
    ];

    public function product(){
        return $this->belongsTo('App\Admin_model\Product');
    }
}
