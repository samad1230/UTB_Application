<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $fillable = [
        'warehouse_id','product_id','buy_price','buy_qty','buy_sub_total','rest_qty','rest_qty_buy_total','sell_price','sell_discount_price','supplier_id','stoke_date','with_free','status','user_id'

    ];

    public function supplier(){
        return $this->belongsTo('App\Supplier_model\Supplier');
    }

    public function product(){
        return $this->belongsTo('App\Admin_model\Product');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }


}
