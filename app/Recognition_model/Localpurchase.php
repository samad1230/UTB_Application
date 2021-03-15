<?php

namespace App\Recognition_model;

use Illuminate\Database\Eloquent\Model;

class Localpurchase extends Model
{
    protected $fillable = [
        'invoice_no','supplier_id','amount','expense','discount','due','date','disburse_date','status'
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
