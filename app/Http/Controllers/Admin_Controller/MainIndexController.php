<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Admin_model\Brand;
use App\Admin_model\Categorie;
use App\Admin_model\Procategorie;
use App\Admin_model\Subcategorie;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MainIndexController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function CategoryIndex()
    {
        $category = Categorie::all();
        return view('Purchase_view.Categorie.categories',compact('category'));
    }

    public function SubcategoryIndex()
    {
        $category = Categorie::all();
       // $subcategory = Subcategorie::all();
        $subcategory = DB::table('subcategories')
            ->select('subcategories.*','categories.name as catname')
            ->join('categories','categories.id','=','subcategories.categorie_id')
            ->get();
        return view('Purchase_view.Categorie.subcategory',compact('category','subcategory'));
    }


    public function ProcategoryIndex()
    {

        $subcategory = Subcategorie::all();
        $procategory = DB::table('procategories')
            ->select('procategories.*','subcategories.name as subcatname')
            ->join('subcategories','subcategories.id','=','procategories.subcategorie_id')
            ->get();
        return view('Purchase_view.Categorie.procategory',compact('subcategory','procategory'));
    }


    public function BrandIndex()
    {
        $brand = Brand::all();
        $category = Categorie::all();
        $subcategory = Subcategorie::all();
        $procategory = Procategorie::all();
        return view('Purchase_view.Categorie.brandview',compact('brand','category','subcategory','procategory'));
    }





}
