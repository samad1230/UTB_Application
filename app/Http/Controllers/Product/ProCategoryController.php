<?php

namespace App\Http\Controllers\Product;

use App\Admin_model\Procategorie;
use App\Admin_model\Subcategorie;
use App\CommonModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProCategoryController extends Controller
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $model_common = new CommonModel();
        $x =  $model_common->slagdata();
        $slag = time().",".str_replace(' ','_', $request->procategory_name).",".$x;

        if($request->hasFile('procatimage')){
            $data= new Procategorie();
            $data['name']=$request->procategory_name;
            $data['subcategorie_id']=$request->subcat_id;
            $data['slag']=$slag;
            $procatimage =$request->procatimage;

            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.DAC_ZS.';
            $procategoryImageFilename = time() . $x . $procatimage->getClientOriginalExtension();
            Image::make($procatimage->getRealPath())->resize(450, 400)->save(public_path('/Media/procategory/' . $procategoryImageFilename));
            $data['procat_image']=$procategoryImageFilename;
            $data->save();
        }else{
            $data= new Procategorie();
            $data['name']=$request->procategory_name;
            $data['subcategorie_id']=$request->subcat_id;
            $data['slag']=$slag;
            $data['procat_image']="";
            $data->save();
        }

        $notification=array(
            'messege'=>'Successfully Pro Categories Insert!',
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
