<?php

namespace App\Account_model;

use Illuminate\Database\Eloquent\Model;

class CashBlanch extends Model
{
    protected $fillable =[
        'date','cash_title','cash_details','receipt','decrypt','blanch','user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
