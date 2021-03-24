<?php

namespace App\Account_model;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'bank_id','deposit','withdraw','blanch','status','user_id','date'
    ];

    public function bank(){
        return $this->belongsTo('App\Account_model\Bank');
    }

    public function bankTransactions(){
        return $this->hasOne('App\Account_model\BankTransaction');
    }
}
