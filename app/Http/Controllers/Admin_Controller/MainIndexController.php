<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Admin_model\Brand;
use App\Admin_model\Categorie;
use App\Admin_model\Procategorie;
use App\Admin_model\Product;
use App\Admin_model\Subcategorie;
use App\Http\Controllers\Controller;
use App\Product_model\Purchase;
use App\Recognition_model\Purchase_Type;
use App\Recognition_model\Recognition;
use App\Recognition_model\Recognition_item;
use App\Supplier_model\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MainIndexController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function CategoryIndex()
    {
        $category = Categorie::all();
        return view('Store_Department.Categorie.categories',compact('category'));
    }

    public function SubcategoryIndex()
    {
        $category = Categorie::all();
       // $subcategory = Subcategorie::all();
        $subcategory = DB::table('subcategories')
            ->select('subcategories.*','categories.name as catname')
            ->join('categories','categories.id','=','subcategories.categorie_id')
            ->get();
        return view('Store_Department.Categorie.subcategory',compact('category','subcategory'));
    }


    public function ProcategoryIndex()
    {

        $subcategory = Subcategorie::all();
        $procategory = DB::table('procategories')
            ->select('procategories.*','subcategories.name as subcatname')
            ->join('subcategories','subcategories.id','=','procategories.subcategorie_id')
            ->get();
        return view('Store_Department.Categorie.procategory',compact('subcategory','procategory'));
    }


    public function BrandIndex()
    {
        $brand = Brand::all();
        $category = Categorie::all();
        $subcategory = Subcategorie::all();
        $procategory = Procategorie::all();
        return view('Store_Department.Categorie.brandview',compact('brand','category','subcategory','procategory'));
    }


    public function ProductDetails()
    {
        $product = Product::orderBy('id','DESC')->get();
        //$product = Product::all();
        return view('Store_Department.Product.productdetails',compact('product'));
    }



    public function ProductEdit($slag)
    {
        $producteditdata = Product::where('slag',$slag)->first();
        $category = Categorie::all();
        $brand = Brand::all();
        $subcategory = Subcategorie::all();
        $procategory = Procategorie::all();
        return view('Store_Department.Product.productdetails_edit',compact('producteditdata','category','brand','subcategory','procategory'));
    }


    public function DetailsProductPurchaseStock()
    {
        $productstokedata = Purchase::where('status',"1")->orderBy('id','DESC')->paginate(15);
        return view('Purchase_view.Purchase.ProductPurchase_stock',compact('productstokedata'));
    }

    public function AddRecognition()
    {
        $supplier = Supplier::all();
        $purchasetype = Purchase_Type::all();
        $product = Product::where('status','1')->get();
        $Recognition = Recognition::orderBy('id','DESC')->paginate(15);
        return view('Store_Department.Recognition.recognition_view',compact('supplier','purchasetype','product','Recognition'));
    }

    public function DetailsRecognition()
    {
        $Recognition = Recognition::orderBy('id','DESC')->paginate(15);
        return view('Store_Department.Recognition.recognition_totalview',compact('Recognition'));
    }

    public function RecognitionStatus()
    {
        $Recognition = Recognition::orderBy('id','DESC')->paginate(15);
        return view('Store_Department.Recognition.recognition_status_view',compact('Recognition'));
    }

    public function ApprovedRecognition()
    {
        $Recognition = Recognition::orderBy('id','DESC')->paginate(15);
        return view('Purchase_view.Recogintion_approve.recognition_approve_view',compact('Recognition'));
    }

    public function ApprovedPurchaseRecognition()
    {
        $Recognition = Recognition::where('status',"1")->orderBy('id','DESC')->paginate(15);
        return view('Accounts_Section.Recognition_purchase.recognition_approve_by_accounts',compact('Recognition'));
    }

}
