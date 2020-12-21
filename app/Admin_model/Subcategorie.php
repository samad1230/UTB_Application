<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Subcategorie extends Model
{
    protected $fillable = [
        'name','categorie_id','subcat_image','slag','status'
    ];

    public function brands()
    {
        return $this->morphToMany('App\Admin_model\Brand','brandable');
    }

    public function category(){
        return $this->belongsTo('App\Admin_model\Categorie');
    }

    public function pro_categories(){
        return $this->hasMany('App\Admin_model\Procategorie');
    }


    public function products()
    {
        return $this->morphToMany('App\Admin_model\Product','productable');
    }

}
