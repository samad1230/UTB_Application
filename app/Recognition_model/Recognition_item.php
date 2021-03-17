<?php

namespace App\Recognition_model;

use Illuminate\Database\Eloquent\Model;

class Recognition_item extends Model
{
  protected $fillable = [
      'recognition_id','product_id','quantity','price','product_status'
  ];

    public function recognition(){
        return $this->belongsTo('App\Recognition_model\Recognition');
    }

    public function product(){
        return $this->belongsTo('App\Admin_model\Product');
    }

    public function lcpurchase(){
        return $this->hasOne('App\Recognition_model\Lcpurchase');
    }

    public function localpurchase(){
        return $this->hasOne('App\Recognition_model\Localpurchase');
    }


}
