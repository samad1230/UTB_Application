<?php

namespace App\Http\Controllers\Store_department;

use App\Http\Controllers\Controller;
use App\Product_model\Warehouse;
use App\Recognition_model\Lcpurchase;
use App\Recognition_model\Localpurchase;
use App\Recognition_model\Purchase_Type;
use App\Recognition_model\Recognition;
use App\Recognition_model\Recognition_item;
use App\Supplier_model\Supplier;
use App\Supplier_model\Supplieraccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecognitionController extends Controller
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
        $userid = Auth::user()->id;
        $requested_data = $request->requested_data;
        $recognition_number = $request->recognition_number;
        $recognition_date = date_format(date_create_from_format('Y-m-d', $request->recognition_date), 'd-m-Y');


            $data = new Recognition();
            $data->recognition_no=$recognition_number;
            $data->recognition_auth=$userid;
            $data->date=$recognition_date;
            $data->status="0";
            $data->save();
            $Recognition = $data->id;

        foreach ($requested_data as $key => $value) {
            $productid = $value["product_id"];
            $quntity_valu = $value["quntity_valu"];

            $data = new Recognition_item();
            $data->recognition_id=$Recognition;
            $data->product_id=$productid;
            $data->quantity=$quntity_valu;
            $data->product_status=0;
            $data->save();
        }
        return response()->json(array("status"=>"success"));
        //return response()->json($value);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recognition_item = Recognition_item::where('recognition_id',$id)->get();

        return view('Store_Department.Recognition.recognition_details_view',compact('recognition_item'));
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
        $data = Recognition_item::find($id);
        $data->quantity=$request->Quantity;
        $data->save();

        $notification=array(
            'messege'=>'Successfully Recognition Item Update!',
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
        $recognition_item = Recognition_item::where('id',$id)->get();
        if (count($recognition_item)==1){
            Recognition_item::where('id', $id)->delete();
            Recognition::where('id', $recognition_item[0]->recognition_id)->delete();
        }

        $notification=array(
            'messege'=>'Successfully Recognition Item Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function Recognitionapprove_details($id)
    {
        $recognition_item = Recognition_item::where('recognition_id',$id)->get();
        $producttype = Purchase_Type::all();
        $supplier = Supplier::where('status',"1")->get();
        return view('Purchase_view.Recogintion_approve.recognition_approve_details_view',compact('recognition_item','producttype','supplier'));
    }


    public function RecognitionPriceUpdate(Request $request)
    {
        $userid = Auth::user()->id;
        $price = $request->price;
        $current = new Carbon();
        $crdate =  $current->format('d-m-Y');
        $Quantity = $request->Quantity;
        $amount = $Quantity * $price;
        $rec_item_id = $request->rec_item_id;
        $status = $request->status;
        $recognition_item = Recognition_item::where('id',$rec_item_id)->first();
        $Recognitionid = $recognition_item->recognition_id;

        $type = $request->producttype;
        if ($status==1){
            if ($type=="LC Purchase"){
                $lcpur = new Lcpurchase();
                $lcpur->recognition_item_id=$rec_item_id;
                $lcpur->Offer_no=$request->offer_no;
                $lcpur->amount=$amount;
                $lcpur->supplier_id=$request->supplier_id;
                $lcpur->date=$crdate;
                $lcpur->status="0";
                $lcpur->save();

            }else{
                $local = new Localpurchase();
                $local->recognition_item_id=$rec_item_id;
                $local->invoice_no=$request->invoice_no;
                $local->amount=$amount;
                $local->supplier_id=$request->supplier_id;
                $local->date=$crdate;
                $local->status="0";
                $local->save();
            }

            $data = Recognition_item::find($rec_item_id);
            $data->price=$request->price;
            $data->quantity=$request->Quantity;
            $data->product_status=$status;
            $data->save();

            $recognition_item_count = Recognition_item::where('recognition_id',$Recognitionid)->where('product_status','0')->get();

            if (count($recognition_item_count) ==0) {
                $data = Recognition::find($Recognitionid);
                $data->approved_by = $userid;
                $data->status = $status;
                $data->save();
            }

        }else{
            $recognition_item_count = Recognition_item::where('recognition_id',$Recognitionid)->where('product_status','0')->get();

            if (count($recognition_item_count) ==0){
                $data = Recognition::find($Recognitionid);
                $data->status=$status;
                $data->save();

                $data = Recognition_item::find($rec_item_id);
                $data->product_status=$status;
                $data->save();
            }else{
                $data = Recognition_item::find($rec_item_id);
                $data->product_status=$status;
                $data->save();
            }
        }

        $notification=array(
            'messege'=>'Successfully Recognition Updated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }


    public function ApprovePurchaseDetails($id)
    {
        $recognition_item = Recognition_item::where('recognition_id',$id)->where('product_status','!=','0')->get();
        return view('Accounts_Section.Recognition_purchase.purchase_approve_details_view',compact('recognition_item'));
    }

    public function AccountsCostAnalysis(Request $request )
    {

        $userid = Auth::user()->id;
        $singlebuyprice = $request->total_amount / $request->Quantity;
        $current = new Carbon();
        $crdate =  $current->format('d-m-Y');

        $purchasetype= Purchase_Type::where('purchase_type',$request->purchase_type)->first();
        $Recognition = Recognition_item::where('id',$request->rec_item_id)->first();

        if ($request->purchase_type=="Local Purchase"){

            $local = Localpurchase::find($request->purchaseid);
            $local->expense=$request->expense;
            $local->discount=$request->discount;
            $local->disburse_date=$request->disburse_date;
            $local->status="1";
            $local->save();

        }else if ($request->purchase_type=="LC Purchase"){

            $local = Lcpurchase::find($request->purchaseid);
            $local->expense=$request->expense;
            $local->discount=$request->discount;
            $local->disburse_date=$request->disburse_date;
            $local->status="1";
            $local->save();
        }

        $data = Recognition_item::find($request->rec_item_id);
        $data->product_status="3";
        $data->save();

        $data = Recognition::find($Recognition->recognition_id);
        $data->status="3";
        $data->save();

        $ware = new Warehouse();
        $ware->recognition_item_id=$request->rec_item_id;
        $ware->purchase_type=$purchasetype->id;
        $ware->product_id=$Recognition->product_id;
        $ware->single_buy_price=$singlebuyprice;
        $ware->quantity=$request->Quantity;
        $ware->total_buy=$request->total_amount;
        $ware->rest_quantity=$request->Quantity;
        $ware->rest_amount=$request->total_amount;
        $ware->supplier_id=$request->supplier_id;
        $ware->purchase_date=$crdate;
        $ware->status="0";
        $ware->user_id=$userid;
        $ware->save();
        $wareid = $ware->id;

        $account = new Supplieraccount();
        $account->supplier_id=$request->supplier_id;
        $account->warehouse_id=$wareid;
        $account->purchase_amount=$request->total_amount;
        $account->date=$crdate;
        $account->save();


        $notification=array(
            'messege'=>'Successfully Purchase Updated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }






}
