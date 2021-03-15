<?php

namespace App\Http\Controllers\Product;

use App\Admin_model\Brand;
use App\CommonModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
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
        $slag = time().",".str_replace(' ','_', $request->brand_name).",".$x;

        if($request->hasFile('brandimage')){
            $data= new Brand();
            $data['name']=$request->brand_name;

            if($request->has('brand_url')){
                $data['brand_url']=$request->brand_url;
            }

            $data['slag']=$slag;
            $brandimage =$request->brandimage;

            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.DAC_ZS.';
            $brandImageFilename = time() . $x . $brandimage->getClientOriginalExtension();
            Image::make($brandimage->getRealPath())->resize(450, 400)->save(public_path('/Media/brand/' . $brandImageFilename));
            $data['brand_image']=$brandImageFilename;
            $data->save();
            $saved_brand = Brand::find($data->id);
        }else{
            $data= new Brand();
            $data['name']=$request->brand_name;
            if($request->has('brand_url')){
                $data['brand_url']=$request->brand_url;
            }
            $data['slag']=$slag;
            $data['brand_image']="";
            $data->save();
            $saved_brand = Brand::find($data->id);
        }

        if($request->has('category_ids')){
            $saved_brand->categories()->sync($request->category_ids);
        }
        if($request->has('subcategory_ids')){
            $saved_brand->subcategories()->sync($request->subcategory_ids);
        }
        if($request->has('procategory_ids')){
            $saved_brand->procategories()->sync($request->procategory_ids);
        }


        $notification=array(
            'messege'=>'Successfully Brand Insert!',
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
        $data= Brand::find($id);
        $data['name']=$request->brand_name;

        if($request->has('brand_url')){
            $data['brand_url']=$request->brand_url;
        }
        $brandimage =$request->brandimage;
        $oldimage =$request->oldimage;

        if($request->hasFile('brandimage')){
            if($oldimage != null){
                $path = 'Media/brand/'.$oldimage;
                unlink($path);
            }
            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.DAC_ZS.';
            $brandImageFilename = time() . $x . $brandimage->getClientOriginalExtension();
            Image::make($brandimage->getRealPath())->resize(450, 400)->save(public_path('/Media/brand/' . $brandImageFilename));
            $data['brand_image']=$brandImageFilename;

        }
        $data->save();
        $saved_brand = Brand::find($id);
        if($request->has('category_ids')){
            $saved_brand->categories()->sync($request->category_ids);
        }
        if($request->has('subcategory_ids')){
            $saved_brand->subcategories()->sync($request->subcategory_ids);
        }
        if($request->has('procategory_ids')){
            $saved_brand->procategories()->sync($request->procategory_ids);
        }


        $notification=array(
            'messege'=>'Successfully Brand Update!',
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
