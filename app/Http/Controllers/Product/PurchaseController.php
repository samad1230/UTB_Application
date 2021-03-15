<?php

namespace App\Http\Controllers\Product;

use App\Admin_model\CommonModel;
use App\Admin_model\Product;
use App\Http\Controllers\Controller;
use App\Product_model\ProductStock;
use App\Product_model\Purchase;
use App\Supplier_model\Supplier;
use App\Supplier_model\Supplieraccount;
use App\Supplier_model\Supplierpayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
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
        $supplier = Supplier::where('status',"1")->get();
        $product = Product::where('status',"1")->get();
        $productstokedata = Purchase::where('status',"1")->paginate(15);

        return view('Purchase_view.Purchase.purchase_view',compact('supplier','product','productstokedata'));
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
        $userid = Auth::user()->id;
        $requested_data = $request->requested_data;
        $cost           = $request->purchase_cost;
        $discount       = $request->discountflat;
        $buy_include    = $request->checkval;

        $balanch = str_replace('-', '', $request->last_balanch);
        $sellingdate = date_format(date_create_from_format('Y-m-d', $request->sellingdate), 'd-m-Y');

        $dataArray = $requested_data;
        $qtysum = 0;
        foreach($dataArray as $key=>$value){
            if(isset($value["quntity_valu"]))
                $qtysum += $value["quntity_valu"];
        }
        if ($buy_include==1){
            $costperQty = $cost / $qtysum;
        }else{
            $costperQty = 0;
        }

        $productcount =  count($dataArray);

        if ($cost==null){
            $labercost = 0;
        }else{
            $labercost = $cost / $productcount;
        }

        if ($discount > 0){
            $discountval = $discount / $productcount;
        }else{
            $discountval = 0;
        }


        $model_common = new CommonModel();
        $offerid =  $model_common->offeriddata();

        foreach ($dataArray as $key => $value) {
            $productid = $value["product_id"];
            $singlebuyprice = $value["singlebuyprice"];
            $quntity_valu = $value["quntity_valu"];
            $singlesubtotal = $value["singlesubtotal"];
            $sell_price = $value["singleprice"];

            if ($sell_price==""){
                $sellprice = 0;
            }else{
                $sellprice = $sell_price;
            }

            $calculateBuy = $singlesubtotal + $labercost;
            $actualBuy = $calculateBuy - $discountval;
            $buyprice=  $singlebuyprice + $costperQty;
            $sub_total_buy=  $buyprice * $quntity_valu;

            $data = new ProductStock();
            $data->offer_id=$offerid;
            $data->product_id=$productid;
            $data->buy_price=$buyprice;
            $data->buy_qty=$quntity_valu;
            $data->buy_sub_total=$sub_total_buy;
            $data->buy_cost=$labercost;
            $data->discount=$discountval;
            $data->actual_buy=$actualBuy;
            $data->rest_qty=$quntity_valu;
            $data->rest_qty_buy_total=$actualBuy;
            $data->sell_price=$sellprice;
            $data->supplier_id=$request->suplierid;
            $data->purchase_date=$sellingdate;
            $data->status="1";
            $data->user_id=$userid;
            $data->save();
        }

        $calculateBuyall = $request->purchase_amount_total + $request->purchase_cost;
        $actualBuytotal = $calculateBuyall - $request->discountflat;

        $data = new Purchase();
        $data->offer_id=$offerid;
        $data->total_buy_amount=$request->purchase_amount_total;
        $data->total_buy_cost=$request->purchase_cost;
        $data->total_buy_discount=$request->discountflat;
        $data->last_buy_amount=$actualBuytotal;
        $data->payment_amount=$request->supplier_payment;
        $data->supplier_id=$request->suplierid;
        $data->purchase_date=$sellingdate;
        $data->status="1";
        $data->user_id=$userid;
        $data->save();



        if ($request->supplier_payment==null){
            $payment_amount = 0;
        }else{
            $payment_amount = $request->supplier_payment;
        }

        if ($cost==null){
            $total_cost = 0;
        }else{
            $total_cost = $cost;
        }
        if ($discount==null){
            $total_discount = 0;
        }else{
            $total_discount = $discount;
        }
        $supplier_accounts_status = Supplieraccount::where('supplier_id',$request->suplierid)
            ->orderBy('id','DESC')
            ->first();
        $sup_old_account = $supplier_accounts_status->accounts;
        $sup_old_status = $supplier_accounts_status->status;

        $lastbuyamount = $total_cost + $request->purchase_amount_total;
        $actualbuy = $lastbuyamount - $total_discount;

        if ($sup_old_status==0){
            $sup_amount = $actualbuy + $sup_old_account;
            $sub_status = $sup_amount - $payment_amount;
        }else{
            if ($actualbuy > $sup_old_account){
                $sup_amount = $actualbuy - $sup_old_account;
                $sub_status = $sup_amount - $payment_amount;
            }else{
                $sup_amount =  $sup_old_account - $actualbuy;
                $sub_status = $sup_amount + $payment_amount;
            }

        }

        if ($sub_status > 0){
            $status = 0;
            $balanchnew = "-".$balanch;
        }else if ($sup_amount < 0){
            $status = 1;
            $balanchnew = $balanch;
        }else{
            $status = 1;
            $balanchnew = $balanch;
        }

        $data = new Supplieraccount();
        $data->offer_id=$offerid;
        $data->supplier_id=$request->suplierid;
        $data->accounts=$balanchnew;
        $data->status=$status;
        $data->save();

        if ($payment_amount !=0){
            $data = new Supplierpayment();
            $data->offer_id=$offerid;
            $data->supplier_id=$request->suplierid;
            $data->payment_date=$sellingdate;
            $data->pay_amount=$payment_amount;
            $data->payment_details="Purchase Product";
            $data->money_receipt="000";
            $data->user_id=$userid;
            $data->status="1";
            $data->save();
        }


        return response()->json(array("status"=>"success"));

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
