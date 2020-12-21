<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Admin_model\Procategorie;
use App\Admin_model\Subcategorie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function CategoryData($id)
    {
        $data = Subcategorie::where('categorie_id',$id)->get();
        return response()->json($data);
    }

    public function SubcategoryData($id)
    {
        $data = Procategorie::where('subcategorie_id',$id)->get();
        return response()->json($data);
    }



}
