<?php

namespace App\Recognition_model;

use Illuminate\Database\Eloquent\Model;

class Recognition extends Model
{
   protected $fillable =[
       'recognition_no','recognition_auth','date','approved_by','invoice_id','lc_no','localpurchase_id','lcpurchase_id','status'
   ];

    public function recognition_items(){
        return $this->hasMany('App\Recognition_model\Recognition_item');
    }

    public function localpurchase(){
        return $this->belongsTo('App\Recognition_model\Localpurchase');
    }

    public function lcpurchase(){
        return $this->belongsTo('App\Recognition_model\Lcpurchase');
    }

}
