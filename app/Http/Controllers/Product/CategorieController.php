<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


}
