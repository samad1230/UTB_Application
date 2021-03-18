<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Account_model\Bank;
use App\Account_model\BankAccount;
use App\Admin_model\Brand;
use App\Admin_model\Categorie;
use App\Admin_model\Prductimage;
use App\Admin_model\Procategorie;
use App\Admin_model\Product;
use App\Admin_model\Subcategorie;
use App\Http\Controllers\Controller;
use App\Product_model\FeatureGroup;
use App\Product_model\FeatureProduct;
use App\Recognition_model\Lcpurchase;
use App\Recognition_model\Localpurchase;
use App\Recognition_model\Recognition_item;
use App\Supplier_model\Supplier;
use App\Supplier_model\Supplieraccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $brand = Brand::where('id',$id)->first();

        $category = [];
        foreach ($brand->categories as $categorie){
            $category [] = [
                $categorie->id,
            ];
        }

        $subcategory = [];
        foreach ($brand->subcategories as $subcategorie){
            $subcategory [] = [
                $subcategorie->id,
            ];
        }

        $procategories = [];
        foreach ($brand->procategories as $procategorie){
            $procategories [] = [
                $procategorie->id,
            ];
        }

        return json_encode(array('category'=>$category,'subcategory'=>$subcategory,'brand'=>$brand));
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
        $image = Prductimage::find($request->imageid);
        $path = 'Media/product/' . $image->product_image;
        unlink($path);
        $image->delete();
        return response()->json('success');
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

    public function AccountsPurchaseSupplier($id)
    {
        $data = Supplieraccount::where('supplier_id',$id)
            ->orderBy('id','DESC')
            ->first();
        return response()->json($data);

    }

    public function PurchaseProductData($id)
    {
        $data = Product::where('id',$id)->first();
        return response()->json($data);

    }

    public function RecognitionItemData($id)
    {
        $Recognition = Recognition_item::where('id',$id)->first();

        $data = [
            'id' => $Recognition->id,
            'recognition_no' => $Recognition->Recognition->recognition_no,
            'product' => $Recognition->product->name,
            'quantity' => $Recognition->quantity,
        ];

        return response()->json($data);
    }

    public function Purchaseapprove_dataItemData($id)
    {
        $Recognition = Recognition_item::where('id',$id)->first();

        $lcpurchase = Lcpurchase::where('recognition_item_id',$id)->first();
        $localpurchase = Localpurchase::where('recognition_item_id',$id)->first();

       if ($lcpurchase !=null){
           $data = [
               'id' => $Recognition->id,
               'recognition_no' => $Recognition->Recognition->recognition_no,
               'product' => $Recognition->product->name,
               'quantity' => $Recognition->quantity,
               'supplier' => $lcpurchase->supplier->company_name,
               'supplier_id' => $lcpurchase->supplier->id,
               'Purchase_Type' => "LC Purchase",
               'amount' => $lcpurchase->amount,
               'purchase_id' => $lcpurchase->id,
           ];
       }else{
           $data = [
               'id' => $Recognition->id,
               'recognition_no' => $Recognition->Recognition->recognition_no,
               'product' => $Recognition->product->name,
               'quantity' => $Recognition->quantity,
               'supplier' => $localpurchase->supplier->company_name,
               'supplier_id' => $localpurchase->supplier->id,
               'Purchase_Type' => "Local Purchase",
               'amount' => $localpurchase->amount,
               'purchase_id' => $localpurchase->id,
           ];
       }

        return response()->json($data);
    }


    public function BankaccountData($id)
    {
        $bankdetails = Bank::where('id',$id)->first();
        $accounts = BankAccount::where('bank_id',$id)->select('bank_id', DB::raw('SUM(deposit) as deposit'), DB::raw('SUM(withdraw) as withdraw'))
            ->groupBy('bank_id')
            ->first();
        $blanch = $accounts->deposit - $accounts->withdraw;
        $data = [
            'id' => $bankdetails->id,
            'account_name' => $bankdetails->account_name,
            'account_no' => $bankdetails->account_no,
            'bank_name' => $bankdetails->bank_name,
            'balanch' => $blanch,

        ];

        return response()->json($data);
    }

}
