<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Prductimage extends Model
{
    protected $fillable = [
        'product_id','product_image'
    ];

    public function product(){
        return $this->belongsTo('App\Admin_model\Product');
    }
}
