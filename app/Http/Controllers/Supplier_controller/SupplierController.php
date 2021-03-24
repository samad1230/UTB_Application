<?php

namespace App\Http\Controllers\Supplier_controller;

use App\Account_model\Bank;
use App\Account_model\BankAccount;
use App\Account_model\BankTransaction;
use App\Account_model\CashBlanch;
use App\Account_model\PaymentDocumet;
use App\Http\Controllers\Controller;
use App\Product_model\Warehouse;
use App\Recognition_model\Recognition_item;
use App\Supplier_model\Supplier;
use App\Supplier_model\Supplieraccount;
use App\Supplier_model\Supplierpayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

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
        $validatedData = $request->validate([
            'company_name' => 'required|unique:suppliers',
        ]);

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

    public function SupplierPayment($id)
    {
        $supplierac = Supplieraccount::where('supplier_id',$id)->select('supplier_id', DB::raw('SUM(purchase_amount) as purchase_amount'), DB::raw('SUM(payment) as payment'))
            ->groupBy('supplier_id')
            ->first();
        $blanch = $supplierac->purchase_amount - $supplierac->payment;
        $warehouse  = Warehouse::where('supplier_id',$id)->first();
        if ($warehouse !=null){
            $recognition_item = Recognition_item::where('id',$warehouse->recognition_item_id)->get();

            $supplierpaymentdata = [
                'supplieriddata' => $id,
                'supplier_name' => $supplierac->supplier->company_name,
                'supplier_blanch' => $blanch,
            ];

            $bankac = Bank::all();

            return view('Accounts_Section.Recognition_purchase.supplier_payment',compact('supplierpaymentdata','bankac','recognition_item'));
        }else{
            return redirect()->back();
        }


    }


    public function SupplierPaymentUpdate(Request $request, $id)
    {
        $userid = Auth::user()->id;
        $supplierdata = Supplier::where('company_name',$request->supplier)->first();

        if ($request->paymenttype=="bank"){
            $blanch = $request->bankacblanch - $request->payamount;

            $bank_ac = new BankAccount();
            $bank_ac->bank_id=$request->bank_id;
            $bank_ac->deposit="0";
            $bank_ac->withdraw=$request->payamount;
            $bank_ac->blanch=$blanch;
            $bank_ac->status="0";
            $bank_ac->user_id=$userid;
            $bank_ac->date=$request->paymentdate;
            $bank_ac->save();
            $bank_accountid = $bank_ac->id;

            $bank = Bank::find($request->bank_id);
            $bank->blanch=$blanch;
            $bank->save();

            $data_trns = new BankTransaction();
            $data_trns->bank_account_id=$bank_accountid;
            $data_trns->bank_id=$request->bank_id;
            $data_trns->amount=$request->payamount;
            $data_trns->purpose="Supplier Payment";

            if($request->has('paymentdetails')){
                $data_trns->details=$request->paymentdetails;
            }

            $data_trns->date=$request->paymentdate;
            $data_trns->save();

            $supplier_ac = new Supplieraccount();
            $supplier_ac->supplier_id=$id;
            $supplier_ac->purchase_amount="0";
            $supplier_ac->payment=$request->payamount;
            $supplier_ac->date=$request->paymentdate;
            $supplier_ac->save();

            $supplier_pay = new Supplierpayment();
            $supplier_pay->supplier_id=$id;
            $supplier_pay->offer_id=$request->recogination_no;
            $supplier_pay->payment_date=$request->paymentdate;
            $supplier_pay->pay_amount=$request->payamount;
            if($request->has('paymentdetails')){
                $supplier_pay->payment_details=$request->paymentdetails;
            }
            if($request->has('checkno')){
                $supplier_pay->money_receipt=$request->checkno;
            }
            $supplier_pay->user_id=$userid;
            $supplier_pay->status="1";
            $supplier_pay->save();
            $supplier_pay_id =$supplier_pay->id;

            $data = new PaymentDocumet();
            $data->payment_id=$supplier_pay_id;
            $data->supplier_id=$id;

            if($request->has('paymentdetails')){
                $data->details=$request->paymentdetails;
            }

            if($request->has('checkno')){
                $data->check_no=$request->checkno;
            }
            if($request->has('checkdate')){
                $data->check_date=$request->checkdate;
            }

            if($request->hasFile('document')){
                $checkimage =$request->document;
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . '.DAC_ZS.';
                $checkimageImageFilename = time() . $x . $checkimage->getClientOriginalExtension();
                Image::make($checkimage->getRealPath())->resize(500, 300)->save(public_path('/Media/supplier_document/' . $checkimageImageFilename));
                $data->document=$checkimageImageFilename;
            }
            $data->save();

        }else{
            $blanch = $request->cashblanch - $request->payamount;

            $data = new CashBlanch();
            $data->date=$request->paymentdate;
            $data->cash_title="Supplier Payment";
            $data->cash_details=$request->payment_note;
            $data->receipt="0";
            $data->decrypt=$request->payamount;
            $data->blanch=$blanch;
            $data->user_id=$userid;
            $data->save();

            $supplier_ac = new Supplieraccount();
            $supplier_ac->supplier_id=$id;
            $supplier_ac->purchase_amount="0";
            $supplier_ac->payment=$request->payamount;
            $supplier_ac->date=$request->paymentdate;
            $supplier_ac->save();

            $supplier_pay = new Supplierpayment();
            $supplier_pay->supplier_id=$id;
            $supplier_pay->offer_id=$request->recogination_no;
            $supplier_pay->payment_date=$request->paymentdate;
            $supplier_pay->pay_amount=$request->payamount;
            if($request->has('paymentdetails')){
                $supplier_pay->payment_details=$request->paymentdetails;
            }
            if($request->has('payment_note')){
                $supplier_pay->money_receipt=$request->payment_note;
            }
            $supplier_pay->user_id=$userid;
            $supplier_pay->status="1";
            $supplier_pay->save();
            $supplier_pay_id =$supplier_pay->id;

            $data = new PaymentDocumet();
            $data->payment_id=$supplier_pay_id;
            $data->supplier_id=$supplierdata->id;

            if($request->has('paymentdetails')){
                $data->details=$request->paymentdetails;
            }

            if($request->has('payment_note')){
                $data->check_no=$request->payment_note;
            }

            if($request->hasFile('document')){
                $checkimage =$request->document;
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . '.DAC_ZS.';
                $checkimageImageFilename = time() . $x . $checkimage->getClientOriginalExtension();
                Image::make($checkimage->getRealPath())->resize(500, 300)->save(public_path('/Media/supplier_document/' . $checkimageImageFilename));
                $data->document=$checkimageImageFilename;
            }
            $data->save();
        }

        $notification=array(
            'messege'=>'Successfully Supplier Payment!',
            'alert-type'=>'success'
        );
        return Redirect()->route('supplier.accounts')->with($notification);


    }

}
