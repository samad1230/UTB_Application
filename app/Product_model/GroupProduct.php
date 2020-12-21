<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class GroupProduct extends Model
{
    protected $fillable = [
        'group_name','product_id'
    ];

    public function product(){
        return $this->belongsTo('App\Admin_model\Product');
    }
}
