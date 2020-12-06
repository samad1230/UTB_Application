<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class User_Profile extends Model
{
    protected $fillable = [
        'user_id','national_id','address','national_id_image','user_image','phone'
    ];
}
