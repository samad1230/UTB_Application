<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class DocfileProduct extends Model
{
    protected $fillable = [
        'doc_file','product_id'
    ];

    public function product(){
        return $this->belongsTo('App\Admin_model\Product');
    }
}
