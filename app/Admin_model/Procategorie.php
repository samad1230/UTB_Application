<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Procategorie extends Model
{
    protected $fillable = [
        'name','subcategorie_id','procat_image','slag','status'
    ];

    public function brands()
    {
        return $this->morphToMany('App\Admin_model\Brand','brandable');
    }
}
