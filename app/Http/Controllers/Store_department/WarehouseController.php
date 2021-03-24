<?php

namespace App\Http\Controllers\Store_department;

use App\Http\Controllers\Controller;
use App\Product_model\ProductStock;
use App\Product_model\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
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
        $product = Warehouse::orderBy('id','DESC')->paginate(15);
        return view('Store_Department.warehouse.product_stoke_view',compact('product'));
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
        //
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
        $validatedData = $request->validate([
            'indate' => 'required',
        ]);

        $userid = Auth::user()->id;

        $data= Warehouse::find($id);
        $data->status="1";
        $data->stoke_in_date=$request->indate;
        $data->save();

        $warehousedata = Warehouse::where('id',$id)->first();

        $data = new ProductStock();
        $data->warehouse_id=$id;
        $data->product_id=$warehousedata->product_id;
        $data->buy_price=$warehousedata->single_buy_price;
        $data->buy_qty=$warehousedata->quantity;
        $data->buy_sub_total=$warehousedata->total_buy;
        $data->rest_qty=$warehousedata->quantity;
        $data->rest_qty_buy_total=$warehousedata->total_buy;
        $data->sell_price="0";
        $data->sell_discount_price="0";
        $data->supplier_id=$warehousedata->supplier_id;
        $data->stoke_date=$request->indate;
        $data->status="1";
        $data->user_id=$userid;
        $data->save();

        $notification=array(
            'messege'=>'Product Store Successfully!',
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
