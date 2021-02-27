<?php

namespace App\Supplier_model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'company_name','person_name','address','mobile','status'
    ];


    public function supplieraccounts()
    {
        return $this->hasMany('App\Supplier_model\Supplieraccount');
    }

    public function supplierpayments()
    {
        return $this->hasMany('App\Supplier_model\Supplierpayment');
    }


    public function purchases(){
        return $this->hasMany('App\Product_model\Purchase');
    }

    public function productStocks(){
        return $this->hasMany('App\Product_model\ProductStock');
    }


}
