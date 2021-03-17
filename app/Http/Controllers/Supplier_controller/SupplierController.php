<?php

namespace App\Http\Controllers\Supplier_controller;

use App\Http\Controllers\Controller;
use App\Supplier_model\Supplier;
use App\Supplier_model\Supplieraccount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
        $current = new Carbon();
        $crdate =  $current->format('d-m-Y');

        $data = new Supplier();
        $data->company_name=$request->company_name;
        $data->person_name=$request->contact_person;
        $data->designation=$request->designation;
        $data->address=$request->address;
        $data->mobile=$request->mobile;
        $data->status=$request->status_id;
        $data->save();
        $suplierid = $data->id;

        if ($request->previus_ledger > 0){
            $payment = $request->previus_ledger;
            if ($payment==null){
                $paymentcash ="0";
            }else{
                $paymentcash =$payment;
            }

            $account = new Supplieraccount();
            $account->supplier_id=$suplierid;
            $account->payment=$paymentcash;
            $account->date=$crdate;
            $account->save();

        }else{
            $purchase = $request->previus_ledger;
            if ($purchase==null){
                $purchase_cash ="0";
            }else{
                $purchasecash =$purchase;
                $purchase_cash = str_replace('-', '', $purchasecash);
            }
            $account = new Supplieraccount();
            $account->supplier_id=$suplierid;
            $account->purchase_amount=$purchase_cash;
            $account->date=$crdate;
            $account->save();
        }



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
