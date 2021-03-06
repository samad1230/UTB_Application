<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','product_details','brand_id','skvalue','warranty','Country_Of_Origin','Made_in_Assemble','stoke_status','status','slag','create_by'
    ];

    public function brands()
    {
        return $this->belongsToMany('App\Admin_model\Brand');
    }

    public function product_images(){
        return $this->hasMany('App\Admin_model\Prductimage');
    }

    public function autocat_products()
    {
        return $this->hasMany('App\Product_model\AutocatProduct');
    }


    public function docfile_products()
    {
        return $this->hasMany('App\Product_model\DocfileProduct');
    }



    public function pdf_products()
    {
        return $this->hasMany('App\Product_model\PdfProduct');
    }

    public function product_videos()
    {
        return $this->hasMany('App\Product_model\ProductVideo');
    }

    public function productStocks()
    {
        return $this->hasMany('App\Product_model\ProductStock');
    }

    public function featuregroups(){
        return $this->hasMany('App\Product_model\FeatureGroup');
    }


    public function categories()
    {
        return $this->morphedByMany('App\Admin_model\Categorie', 'productable');
    }

    public function subcategories()
    {
        return $this->morphedByMany('App\Admin_model\Subcategorie', 'productable');
    }

    public function procategories()
    {
        return $this->morphedByMany('App\Admin_model\Procategorie', 'productable');
    }

    public function warehouse(){
        return $this->hasOne('App\Product_model\Warehouse');
    }


    public function recognition_items(){
        return $this->hasMany('App\Recognition_model\Recognition_item');
    }

}
