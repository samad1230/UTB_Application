<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = [
        'name','categorie_image','slag','status'
    ];


    public function brands()
    {
        return $this->morphToMany('App\Admin_model\Brand','brandable');
    }

}
