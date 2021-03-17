<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable=[
        'recognition_item_id','purchase_type','product_id','single_buy_price','quantity','total_buy','rest_quantity','rest_amount','supplier_id','purchase_date','status','user_id'
    ];
}
