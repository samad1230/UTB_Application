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
}
