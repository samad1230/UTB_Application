<?php

namespace App\Http\Controllers\SellsDepartment;

use App\Http\Controllers\Controller;
use App\Product_model\ProductStock;
use Illuminate\Http\Request;

class SellUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $productdata = ProductStock::orderBy('id','DESC')->paginate(15);
        return view('Sells_Section.Product_manage.sales_product_view',compact('productdata'));
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
        $alldata = ProductStock::where('id',$id)->first();

        $data = [
            'id' => $alldata->id,
            'buy_price' => $alldata->buy_price,
            'buy_qty' => $alldata->buy_qty,
            'sell_price' => $alldata->sell_price,
            'sell_discount_price' => $alldata->sell_discount_price,
            'product_id' => $alldata->product->name,
        ];

        return response()->json($data);
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
        $data = ProductStock::find($id);
        $data->sell_price=$request->sellprice;
        $data->sell_discount_price=$request->discountprice;
        $data->save();

        $notification=array(
            'messege'=>'Product Price Update Successfully!',
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
