<?php

namespace App\Http\Controllers\Product;

use App\Admin_model\Categorie;
use App\CommonModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $model_common = new CommonModel();
        $x =  $model_common->slagdata();
        $slag = time().",".str_replace(' ','_', $request->category_name).",".$x;

        if($request->hasFile('catimage')){
            $data= new Categorie();
            $data['name']=$request->category_name;
            $data['slag']=$slag;
            $catimage =$request->catimage;

            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.DAC_ZS.';
            $categoryImageFilename = time() . $x . $catimage->getClientOriginalExtension();
            Image::make($catimage->getRealPath())->resize(450, 400)->save(public_path('/Media/category/' . $categoryImageFilename));
            $data['categorie_image']=$categoryImageFilename;
            $data->save();
        }else{
            $data= new Categorie();
            $data['name']=$request->category_name;
            $data['slag']=$slag;
            $data['categorie_image']="";
            $data->save();
        }

        $notification=array(
            'messege'=>'Successfully Categories Insert!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
