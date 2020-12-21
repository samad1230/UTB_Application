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

    public function sub_categories(){
        return $this->hasMany('App\Admin_model\Subcategorie');
    }


    public function products()
    {
        return $this->morphToMany('App\Admin_model\Product','productable');
    }

}
