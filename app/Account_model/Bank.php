<?php

namespace App\Account_model;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'account_name','account_no','blanch','bank_name'
    ];

    public function bankaccount()
    {
        return $this->hasMany('App\Account_model\BankAccount');
    }
}
