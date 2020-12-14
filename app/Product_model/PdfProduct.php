<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class PdfProduct extends Model
{
    protected $fillable = [
        'pdf_file','product_id'
    ];

    public function product(){
        return $this->belongsTo('App\Admin_model\Product');
    }
}
