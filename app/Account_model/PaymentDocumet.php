<?php

namespace App\Account_model;

use Illuminate\Database\Eloquent\Model;

class PaymentDocumet extends Model
{
    protected $fillable = [
        'payment_id','supplier_id','check_no','check_date','details','document'
    ];
}
