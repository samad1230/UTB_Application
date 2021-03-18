<?php

namespace App\Http\Controllers\Accounts_Controller;

use App\Account_model\Bank;
use App\Account_model\BankAccount;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
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
        $validatedData = $request->validate([
            'account_name' => 'required',
            'account_no' => 'required'
        ]);

        $current = new Carbon();
        $crdate =  $current->format('d-m-Y');
        $userid = Auth::user()->id;

        $data = new Bank();
        $data ->account_name=$request->account_name;
        $data ->account_no=$request->account_no;
        $data ->blanch=$request->prevcash;
        $data ->bank_name=$request->bankname;
        $data->save();
        $saveid = $data->id;

        $data = new BankAccount();
        $data ->bank_id=$saveid;
        $data ->deposit=$request->prevcash;
        $data ->withdraw=0;
        $data ->blanch=$request->prevcash;
        $data ->date=$crdate;
        $data ->user_id=$userid;
        $data ->status=1;
        $data->save();

        $notification=array(
            'messege'=>'Successfully Bank Account Inserted',
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
        $accountdetails = BankAccount::where('bank_id',$id)->get();
        return view('Accounts_Section.Recognition_purchase.bank_account_view_details',compact('accountdetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Bank::where('id',$id)->first();
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
        $data = Bank::find($id);
        $data ->account_name=$request->account_name;
        $data ->account_no=$request->account_no;
        $data ->bank_name=$request->bankname;
        $data->save();
        $notification=array(
            'messege'=>'Successfully Bank Account Update',
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

    public function BankDeposit(Request $request)
    {
        $current = new Carbon();
        $crdate =  $current->format('d-m-Y');
        $userid = Auth::user()->id;

        $data = new BankAccount();
        $data ->bank_id=$request->dataid;
        $data ->deposit=$request->depositcash;
        $data ->blanch=$request->lastcash;
        $data ->date=$crdate;
        $data ->withdraw=0;
        $data ->user_id=$userid;
        $data ->status=1;
        $data->save();

        $data = Bank::find($request->dataid);
        $data ->blanch=$request->lastcash;
        $data->save();

        $notification=array(
            'messege'=>'Successfully Bank Deposit !',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }
}
