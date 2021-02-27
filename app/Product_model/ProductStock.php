<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $fillable = [
        'offer_id','product_id','buy_price','buy_qty','buy_sub_total','buy_cost','discount','actual_buy','rest_qty','rest_qty_buy_total','sell_price','sell_discount_price','supplier_id','purchase_date','purchase_type','with_free','status','user_id'

    ];

    public function supplier(){
        return $this->belongsTo('App\Supplier_model\Supplier');
    }

    public function product(){
        return $this->belongsTo('App\Admin_model\Product');
    }


}
