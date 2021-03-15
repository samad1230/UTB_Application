<?php

namespace App\Http\Controllers\Product;

use App\Admin_model\Categorie;
use App\Admin_model\Prductimage;
use App\Admin_model\Procategorie;
use App\Admin_model\Product;
use App\Admin_model\Subcategorie;
use App\CommonModel;
use App\Http\Controllers\Controller;
use App\Product_model\AutocatProduct;
use App\Product_model\DocfileProduct;
use App\Product_model\FeatureGroup;
use App\Product_model\FeatureProduct;
use App\Product_model\PdfProduct;
use App\Product_model\ProductVideo;
use Illuminate\Http\Request;
use App\Admin_model\Brand;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
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
        $product = Product::all();
        $brand = Brand::where('brand_url','=',NULL)->get();
        $category = Categorie::all();
        $subcategory = Subcategorie::all();
        $procategory = Procategorie::all();
        return view('Store_Department.Product.productview',compact('product','brand','category','procategory','subcategory'));
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

//        $feature = [];
//        if($request->has('feature_group_name')){
//            for ($i = 0; $i <count($request->feature_group_name); $i++){
//                $freaturesList = [];
//                $featureFildName = preg_replace('/\s+/', '', $request->feature_group_name[$i]).'_name';
//                $featureFildMaterial = preg_replace('/\s+/', '', $request->feature_group_name[$i]).'_material';
//                if(count($request->$featureFildName) == count($request->$featureFildMaterial)){
//                    for ($x = 0; $x <count($request->$featureFildName); $x++){
//                        $freaturesList[] = [
//                            'name' => $request->$featureFildName[$x],
//                            'material' => $request->$featureFildName[$x],
//                        ];
//                    }
//                }
//                $feature[] =  [
//                    'groupName' => $request->feature_group_name[$i],
//                    'features' => $freaturesList,
//                ];
//            }
//        }


        $model_common = new CommonModel();
        $x =  $model_common->slagdata();
        $slag = time().",".str_replace(' ','_', $request->productname).",".$x;
        $loginid = Auth::user()->id;

        $data= new Product();
        $data['name']=$request->productname;
        $data['product_details']=$request->productdetails;
        $data['brand_id']=$request->brandid;
        $data['skvalue']=$request->skvalue;
        $data['warranty']=$request->warranty;
        $data['Country_Of_Origin']=$request->cuntryorigin;
        $data['Made_in_Assemble']=$request->madeassemble;
        $data['stoke_status']=$request->stokestatus;
        $data['popular_product']=$request->popularproduct;
        $data['feature_product']=$request->featureproduct;
        $data['slag']=$slag;
        $data['create_by']=$loginid;
        $data->save();
        $productid = $data->id;
        $saved_product = Product::find($data->id);

        $saved_product->brands()->sync($request->brandid,false);

        if($request->has('feature_group_name')){
            for ($i = 0; $i < count($request->feature_group_name); $i++){
                $featureGroup = new FeatureGroup();
                $featureGroup->product_id = $saved_product->id;
                $featureGroup->group_name = $request->feature_group_name[$i];
                $featureGroup->save();
                $featureGroup_save = FeatureGroup::find($featureGroup->id);
//                dd($featureGroup_save_id);
                $featureFildName = preg_replace('/\s+/', '', $request->feature_group_name[$i]).'_name';
                $featureFildMaterial = preg_replace('/\s+/', '', $request->feature_group_name[$i]).'_material';
                if(count($request->$featureFildName) == count($request->$featureFildMaterial)){
                    for ($x = 0; $x <count($request->$featureFildName); $x++){
                        $feature = new FeatureProduct();
                        $feature->feature_name = $request->$featureFildName[$x];
                        $feature->material = $request->$featureFildMaterial[$x];
                        $feature->feature_group_id = $featureGroup_save->id;
                        $feature->save();

                    }
                }
            }
        }
       //dd($feature);
        if($request->hasFile('company_logo')){
            foreach ($request->company_logo as $item => $imagevalue) {
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . '.DAC_ZS.';
                $productImageFilename = time() . $x . $imagevalue->getClientOriginalExtension();
                Image::make($imagevalue->getRealPath())->resize(800, 700)->save(public_path('/Media/product/' . $productImageFilename));

                $dataimage = array(
                    'product_id' => $productid,
                    'product_image' => $productImageFilename,
                );
                Prductimage::insert($dataimage);
            }
        }

        if ($request->hasfile('docfile_products')) {
            foreach ($request->file('docfile_products') as $file) {
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . '.DAC_ZS.';
                $filename = time() . $x . $file->getClientOriginalExtension();
                $file->move(public_path() . '/Media/file/', $filename);
                $datafile = array(
                    'product_id' => $productid,
                    'doc_file' => $filename,
                );
                DocfileProduct::insert($datafile);
            }
        }

        if ($request->hasfile('pdf_products')) {
            foreach ($request->file('pdf_products') as $file) {
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . '.DAC_ZS.';
                $filename = time() . $x . $file->getClientOriginalExtension();
                $file->move(public_path() . '/Media/file/', $filename);
                $datafile = array(
                    'product_id' => $productid,
                    'pdf_file' => $filename,
                );
                PdfProduct::insert($datafile);
            }
        }

        if ($request->hasfile('autocat_products')) {
            foreach ($request->file('autocat_products') as $file) {
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . '.DAC_ZS.';
                $filename = time() . $x . $file->getClientOriginalExtension();
                $file->move(public_path() . '/Media/file/', $filename);
                $datafile = array(
                    'product_id' => $productid,
                    'autocad_file' => $filename,
                );
                AutocatProduct::insert($datafile);
            }
        }

        if ($request->hasfile('product_videos')) {
            foreach ($request->product_videos as $item => $video) {
                $dataf = array(
                    'product_id' => $productid,
                    'video_name' => $video,
                );
                ProductVideo::insert($dataf);
            }
        }


        if($request->has('category_ids')){
            $saved_product->categories()->sync($request->category_ids);
        }
        if($request->has('subcategory_ids')){
            $saved_product->subcategories()->sync($request->subcategory_ids);
        }
        if($request->has('procategory_ids')){
            $saved_product->procategories()->sync($request->procategory_ids);
        }

        $notification=array(
            'messege'=>'Successfully Product Insert!',
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
        $loginid = Auth::user()->id;

        $product = Product::where('slag',$id)->first();

        $product->name = $request->productname;
        $product->product_details = $request->productdetails;
        $product->brand_id = $request->brandid;
        $product->skvalue = $request->skvalue;
        $product->warranty = $request->warranty;
        $product->Country_Of_Origin = $request->cuntryorigin;
        $product->Made_in_Assemble = $request->madeassemble;
        $product->stoke_status = $request->stokestatus;
        $product->popular_product = $request->popularproduct;
        $product->feature_product = $request->featureproduct;
        $product->create_by = $loginid;
        $product->save();


        $haveFeatureGroups = $product->featuregroups;
        if($request->has('feature_group_name')){
            if(count($haveFeatureGroups) > 0) {
                foreach ($haveFeatureGroups as $haveFeatureGroup) {
                    for ($i = 0; $i < count($request->feature_group_name); $i++) {
                        if ($haveFeatureGroup->group_name == $request->feature_group_name[$i]) {
                            $featureFildName = preg_replace('/\s+/', '', $request->feature_group_name[$i]) . '_name';
                            $featureFildMaterial = preg_replace('/\s+/', '', $request->feature_group_name[$i]) . '_material';

                            if ($request->has($featureFildName) && $request->has($featureFildMaterial)) {

                                if (count($request->$featureFildName) == count($request->$featureFildMaterial)) {
                                    for ($x = 0; $x < count($request->$featureFildName); $x++) {
                                        $feature = new FeatureProduct();
                                        $feature->feature_name = $request->$featureFildName[$x];
                                        $feature->material = $request->$featureFildMaterial[$x];
                                        $feature->feature_group_id = $haveFeatureGroup->id;
                                        $feature->save();

                                    }
                                }
                            }
                        } else {
                            $featureGroup = new FeatureGroup();
                            $featureGroup->product_id = $product->id;
                            $featureGroup->group_name = $request->feature_group_name[$i];
                            $featureGroup->save();
                            $featureGroup_save = FeatureGroup::find($featureGroup->id);
                            $featureFildName = preg_replace('/\s+/', '', $request->feature_group_name[$i]) . '_name';
                            $featureFildMaterial = preg_replace('/\s+/', '', $request->feature_group_name[$i]) . '_material';
                            if (count($request->$featureFildName) == count($request->$featureFildMaterial)) {
                                for ($x = 0; $x < count($request->$featureFildName); $x++) {
                                    $feature = new FeatureProduct();
                                    $feature->feature_name = $request->$featureFildName[$x];
                                    $feature->material = $request->$featureFildMaterial[$x];
                                    $feature->feature_group_id = $featureGroup_save->id;
                                    $feature->save();

                                }
                            }
                        }
                    }
                }
            }else{
                for ($v = 0; $v < count($request->feature_group_name); $v++){
                    $featureGroup = new FeatureGroup();
                    $featureGroup->product_id = $product->id;
                    $featureGroup->group_name = $request->feature_group_name[$v];
                    $featureGroup->save();
                    $featureGroup_save = FeatureGroup::find($featureGroup->id);
                    $featureFildName = preg_replace('/\s+/', '', $request->feature_group_name[$v]).'_name';
                    $featureFildMaterial = preg_replace('/\s+/', '', $request->feature_group_name[$v]).'_material';
                    if(count($request->$featureFildName) == count($request->$featureFildMaterial)){
                        for ($x = 0; $x <count($request->$featureFildName); $x++){
                            $feature = new FeatureProduct();
                            $feature->feature_name = $request->$featureFildName[$x];
                            $feature->material = $request->$featureFildMaterial[$x];
                            $feature->feature_group_id = $featureGroup_save->id;
                            $feature->save();

                        }
                    }
                }
            }
        }

        if($request->hasFile('company_logo')){
            foreach ($request->company_logo as $item => $imagevalue) {
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . '.DAC_ZS.';
                $productImageFilename = time() . $x . $imagevalue->getClientOriginalExtension();
                Image::make($imagevalue->getRealPath())->resize(800, 700)->save(public_path('/Media/product/' . $productImageFilename));

                $dataimage = array(
                    'product_id' => $product->id,
                    'product_image' => $productImageFilename,
                );
                Prductimage::insert($dataimage);
            }
        }


        if ($request->has('product_videos')) {
            $video = $product->product_videos;
            foreach ($video as $videos) {
                $videos->product_id = $product->id;
                $videos->video_name = $request->product_videos;
                $videos->save();
            }
        }

        if($request->has('category_ids')){
            $product->categories()->sync($request->category_ids);
        }else{
            $product->categories()->sync(array([]));
        }

        if($request->has('subcategory_ids')){
            $product->subcategories()->sync($request->subcategory_ids);
        }else {
            $product->subcategories()->sync(array([]));
        }

        if($request->has('procategory_ids')){
            $product->procategories()->sync($request->procategory_ids);
        }else{
            $product->procategories()->sync(array([]));
        }

        $notification=array(
            'messege'=>'Successfully Product Insert!',
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
