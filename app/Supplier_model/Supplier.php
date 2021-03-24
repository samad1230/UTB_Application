<?php

namespace App\Supplier_model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'company_name','person_name','designation','address','mobile','status'
    ];


    public function supplieraccounts()
    {
        return $this->hasMany('App\Supplier_model\Supplieraccount');
    }

    public function supplierpayments()
    {
        return $this->hasMany('App\Supplier_model\Supplierpayment');
    }


    public function productStocks(){
        return $this->hasMany('App\Product_model\ProductStock');
    }


    public function localpurchases(){
        return $this->hasMany('App\Recognition_model\Localpurchase');
    }

    public function lcpurchases(){
        return $this->hasMany('App\Recognition_model\Lcpurchase');
    }

    public function warehouse(){
        return $this->hasOne('App\Product_model\Warehouse');
    }
}
