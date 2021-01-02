<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Admin_model\Brand;
use App\Admin_model\Categorie;
use App\Admin_model\Prductimage;
use App\Admin_model\Procategorie;
use App\Admin_model\Product;
use App\Admin_model\Subcategorie;
use App\Http\Controllers\Controller;
use App\Product_model\FeatureGroup;
use App\Product_model\FeatureProduct;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function CategoresEditdata($id)
    {
        $data = Categorie::where('id',$id)->first();
        return response()->json($data);
    }

    public function SubCategoresEditdata($id)
    {
        $data = Subcategorie::where('id',$id)->first();
        return response()->json($data);
    }

    public function ProCategoresEditdata($id)
    {
        $data = Procategorie::where('id',$id)->first();
        return response()->json($data);
    }

    public function BrandEditdata($id)
    {
        $data = Brand::where('id',$id)->first();
        return response()->json($data);
    }

    public function ProductFetureData($slag)
    {
        $product = Product::where('slag',$slag)->first();
        $data = [];
        foreach ($product->featuregroups as $featuregroup){
            $data [] = [
                'id' => $featuregroup->id,
              'name' => $featuregroup->group_name,
                'featuresItem' => $featuregroup->features,
            ];
        }
        return response()->json($data);
    }


    public function ProductCategoryesData($slag)
    {
        $product = Product::where('slag',$slag)->first();
       // $data = $product->categories;
        $category = [];
        foreach ($product->categories as $categorie){
            $category [] = [
                $categorie->id,
            ];
        }

        $subcategory = [];
        foreach ($product->subcategories as $subcategorie){
            $subcategory [] = [
                $subcategorie->id,
            ];
        }

        $procategories = [];
        foreach ($product->procategories as $procategorie){
            $procategories [] = [
                $procategorie->id,
            ];
        }
        $brand = [];
        foreach ($product->brands as $brands){
            $brand [] = [
                $brands->id,
            ];
        }

        $images = [];
        foreach ($product->product_images as $image){
            $images [] = [
                'id' => $image->id,
                'name' => $image->product_image,
            ];
        }

        return json_encode(array('category'=>$category,'subcategory'=>$subcategory,'brand'=>$brand,'procategory'=>$procategories,'image'=>$images));

    }

    public function ProductimageRemove(Request $request)
    {
        Prductimage::where('id', $request->imageid)->delete();
        return response()->json("success");
    }

    public function Feature_id_Remove(Request $request)
    {
        FeatureProduct::where('id', $request->feature_id)->delete();
        return response()->json("success");
    }

    public function FeatureGroupRemove(Request $request)
    {
        FeatureGroup::where('id', $request->feature_group)->delete();

        FeatureProduct::where('feature_group_id', $request->feature_group)->delete();
        return response()->json("success");
    }



}
