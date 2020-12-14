<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class AutocatProduct extends Model
{
    protected $fillable = [
        'autocad_file','product_id'
    ];

    public function product(){
        return $this->belongsTo('App\Admin_model\Product');
    }
}
