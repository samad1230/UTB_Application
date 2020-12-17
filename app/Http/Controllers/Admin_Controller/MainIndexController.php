<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Admin_model\Categorie;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;


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


}
