<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'offer_id','total_buy_amount','total_buy_cost','total_buy_discount','last_buy_amount','payment_amount','supplier_id','purchase_date','status','user_id'
    ];

    public function supplier(){
        return $this->belongsTo('App\Supplier_model\Supplier');
    }

    public function product(){
        return $this->belongsTo('App\Admin_model\Product');
    }

}
