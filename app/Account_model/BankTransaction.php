<?php

namespace App\Account_model;

use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
  protected $fillable = [
      'bank_account_id','bank_id','amount','purpose','details','date'
  ];

    public function bankaccount()
    {
        return $this->belongsTo('App\Account_model\BankAccount');
    }

}
