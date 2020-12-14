<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service_name','service_title','slag','status'
    ];
}
