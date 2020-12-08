<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Dipertment extends Model
{
    protected $fillable = [
        'name'
    ];
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}


