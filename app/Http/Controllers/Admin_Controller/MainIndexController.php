<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;


class MainIndexController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


}
