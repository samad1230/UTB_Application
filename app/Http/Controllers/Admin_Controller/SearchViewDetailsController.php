<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use App\Product_model\ProductStock;
use App\Product_model\Purchase;
use App\Supplier_model\Supplieraccount;
use Illuminate\Http\Request;

class SearchViewDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function Allproduct_stokedata(Request $request)
    {
        $searchdata = $request->search;

        if($request->ajax()) {
            $output="";
            $stokedata = Purchase::where('offer_id', 'LIKE', '%' . $searchdata . '%')
                ->orderBy('id','DESC')
                ->paginate(15);

            $i=1;
            foreach ($stokedata as $key => $product) {
                $balanch = $product->last_buy_amount - $product->payment_amount;

                $output.='<tr>'.
                    '<td>'.$i.'</td>'.
                    '<td>'.$product->purchase_date.'</td>'.
                    '<td>'.$product->offer_id.'</td>'.
                    '<td>'.$product->supplier->company_name.'</td>'.
                    '<td>'.$product->total_buy_amount.'</td>'.
                    '<td>'.$product->total_buy_cost.'</td>'.
                    '<td>'.$product->total_buy_discount.'</td>'.
                    '<td>'.$product->last_buy_amount.'</td>'.
                    '<td>'.$product->payment_amount.'</td>'.
                    '<td>'.$balanch.'</td>'.
                    '<td>'.'<button type="button" class="btn btn-primary btn-sm product_view">View</button>'.'</td>'.
                    '<td>'.'<button type="button" class="btn btn-danger btn-sm product_view">Delete</button>'.'</td>'.
                    '</tr>';
                $i++;
            }
            return Response($output);
        }
    }


    public function DetailsPurchaseView($id)
    {
      $purchasedetaisl = ProductStock::where('offer_id',$id)->get();

      $singlePurchase = Purchase::where('offer_id', $id)->first();

        if ($purchasedetaisl !=null){
            $suplier_offerid = Supplieraccount::where('supplier_id',$singlePurchase->supplier_id)->get();
            for ($i = 1; $i < count($suplier_offerid); $i++){
                if ($suplier_offerid[$i]->offer_id==$id){
                    $pre_offerid = $suplier_offerid[$i-1]->offer_id;
                }
            }
            $previus_offerid = SupplierAccount::where('offer_id',$pre_offerid)->where('supplier_id',$singlePurchase->supplier_id)->first();

            $last_offerid = SupplierAccount::where('offer_id',$id)->orderBy('id','DESC')->first();
            return view('Purchase_view.Purchase.ProductPurchaseDetails',compact('purchasedetaisl','singlePurchase','previus_offerid','last_offerid'));

        }else{
            return redirect()->back();
        }


    }


}
