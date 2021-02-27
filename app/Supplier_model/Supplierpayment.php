<?php

namespace App\Supplier_model;

use Illuminate\Database\Eloquent\Model;

class Supplierpayment extends Model
{
    protected $fillable = [
        'supplier_id','offer_id','payment_date','pay_amount','payment_details','money_receipt','user_id','status'
    ];

    public function supplier(){
        return $this->belongsTo('App\Supplier_model\Supplier');
    }
}
