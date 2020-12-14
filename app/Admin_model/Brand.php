<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name','brand_image','slag','status'
    ];

    public function categories()
    {
        return $this->morphedByMany('App\Admin_model\Categorie', 'brandable');
    }

    public function subcategories()
    {
        return $this->morphedByMany('App\Admin_model\Subcategorie', 'brandable');
    }

    public function procategories()
    {
        return $this->morphedByMany('App\Admin_model\Procategorie', 'brandable');
    }

    public function products()
    {
       return $this->belongsToMany('App\Admin_model\Product') ;
    }

}
