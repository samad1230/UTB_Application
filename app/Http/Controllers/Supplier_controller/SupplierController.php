<?php

namespace App\Http\Controllers\Supplier_controller;

use App\Http\Controllers\Controller;
use App\Supplier_model\Supplier;
use App\Supplier_model\Supplieraccount;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return view('Purchase_view.Supplier.supplier_view',compact('supplier'));
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
        $validatedData = $request->validate([
            'company_name' => 'required|unique:suppliers',
            'contact_person'=>'required',
            'mobile'=>'required',
            'status_id'=>'required',
        ]);

        $data = new Supplier();
        $data->company_name=$request->company_name;
        $data->person_name=$request->contact_person;
        $data->address=$request->address;
        $data->mobile=$request->mobile;
        $data->status=$request->status_id;
        $data->save();
        $suplierid = $data->id;

        if ($request->previus_ledger > 0){
            $status = "0";
        }else{
            $status = "1";
        }

        $account = new Supplieraccount();
        $account->supplier_id=$suplierid;
        $account->offer_id="101";
        $account->accounts=$request->previus_ledger;
        $account->status=$status;
        $account->save();

        $notification=array(
            'messege'=>'Successfully Supplier Inserted!',
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
        $supplier = Supplier::where('id',$id)->first();
        return response()->json($supplier);
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
        $data = Supplier::find($id);
        $data->company_name=$request->companyname;
        $data->person_name=$request->contactperson;
        $data->address=$request->address_data;
        $data->mobile=$request->mobileno;
        $data->status=$request->status_id;
        $data->save();
        $notification=array(
            'messege'=>'Successfully Supplier Update!',
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
