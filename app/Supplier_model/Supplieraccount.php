<?php

namespace App\Supplier_model;

use Illuminate\Database\Eloquent\Model;

class Supplieraccount extends Model
{
    protected $fillable = [
        'supplier_id','warehouse_id','purchase_amount','payment','date'
    ];


    public function supplier(){
        return $this->belongsTo('App\Supplier_model\Supplier');
    }


}
