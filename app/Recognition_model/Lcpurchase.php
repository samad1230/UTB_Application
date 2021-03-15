<?php

namespace App\Recognition_model;

use Illuminate\Database\Eloquent\Model;

class Lcpurchase extends Model
{
    protected $fillable = [
        'lc_no','Offer_no','supplier_id','amount','expense','discount','date','disburse_date','status'
    ];

    public function recognitions(){
        return $this->hasMany('App\Recognition_model\Recognition');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier_model\Supplier');
    }

    public function recognition_item()
    {
        return $this->belongsTo('App\Recognition_model\Recognition_item');
    }

}
