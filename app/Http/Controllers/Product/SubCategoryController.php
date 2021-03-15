<?php

namespace App\Http\Controllers\Product;

use App\Admin_model\Categorie;
use App\Admin_model\Subcategorie;
use App\CommonModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        $slag = time().",".str_replace(' ','_', $request->subcategory_name).",".$x;

        if($request->hasFile('subcatimage')){
            $data= new Subcategorie();
            $data['name']=$request->subcategory_name;
            $data['categorie_id']=$request->cate_id;
            $data['slag']=$slag;
            $subcatimage =$request->subcatimage;

            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.DAC_ZS.';
            $subcategoryImageFilename = time() . $x . $subcatimage->getClientOriginalExtension();
            Image::make($subcatimage->getRealPath())->resize(450, 400)->save(public_path('/Media/subcategory/' . $subcategoryImageFilename));
            $data['subcat_image']=$subcategoryImageFilename;
            $data->save();
        }else{
            $data= new Subcategorie();
            $data['name']=$request->subcategory_name;
            $data['categorie_id']=$request->cate_id;
            $data['slag']=$slag;
            $data['subcat_image']="";
            $data->save();
        }

        $notification=array(
            'messege'=>'Successfully Sub Categories Insert!',
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

        $oldimage =$request->oldimage;

        $data= Subcategorie::find($id);
        $data['name']=$request->subcategory_name;
        $data['categorie_id']=$request->cate_id;
        $subcatimage =$request->subcatimage;

        if($request->hasFile('subcatimage')){
            if($oldimage != null){
                $path = 'Media/subcategory/'.$oldimage;
                unlink($path);
            }
            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.DAC_ZS.';
            $subcategoryImageFilename = time() . $x . $subcatimage->getClientOriginalExtension();
            Image::make($subcatimage->getRealPath())->resize(450, 400)->save(public_path('/Media/subcategory/' . $subcategoryImageFilename));
            $data['subcat_image']=$subcategoryImageFilename;

        }
        $data->save();

        $notification=array(
            'messege'=>'Successfully Sub Categories Updated!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);


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
