<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable=[
        'recognition_item_id','purchase_type','product_id','single_buy_price','quantity','total_buy','rest_quantity','rest_amount','supplier_id','purchase_date','status','stoke_in_date','user_id'
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

    public function purchase_Type(){
        return $this->belongsTo('App\Recognition_model\Purchase_Type');
    }


}
