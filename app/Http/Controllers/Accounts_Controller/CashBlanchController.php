<?php

namespace App\Http\Controllers\Accounts_Controller;

use App\Account_model\Bank;
use App\Account_model\BankAccount;
use App\Account_model\CashBlanch;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashBlanchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashbalanch = CashBlanch::orderBy('id','DESC')->first();
        $blanch= CashBlanch::orderBy('id','DESC')->get();
        $bank = Bank::all();
        return view('Accounts_Section.Recognition_purchase.cash_blanch_view',compact('cashbalanch','blanch','bank'));
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
            'title' => 'required',
            'details' => 'required',
            'receipt' => 'required'
        ]);

        $current = new Carbon();
        $crdate =  $current->format('d-m-Y');
        $userid = Auth::user()->id;

        $cashbalanch = CashBlanch::orderBy('id','DESC')->first();

        if ($cashbalanch !=null){
            $lastblanch = $cashbalanch->blanch + $request->receipt;
        }else{
            $lastblanch = $request->receipt;
        }

        $data = new CashBlanch();
        $data ->date=$crdate;
        $data ->cash_title=$request->title;
        $data ->cash_details=$request->details;
        $data ->receipt=$request->receipt;
        $data ->decrypt="0";
        $data ->blanch=$lastblanch;
        $data ->user_id=$userid;
        $data->save();

        if ($request->title=="Bank Windrow"){
            $bankdata = BankAccount::where('bank_id',$request->bank_id)->orderBy('id','DESC')->first();

            $lastcash = $bankdata->blanch - $request->receipt;

            $data = new BankAccount();
            $data ->bank_id=$request->bank_id;
            $data ->deposit="0";
            $data ->blanch=$lastcash;
            $data ->date=$crdate;
            $data ->withdraw=$request->receipt;
            $data ->user_id=$userid;
            $data ->status=1;
            $data->save();

            $data = Bank::find($request->bank_id);
            $data ->blanch=$lastcash;
            $data->save();
        }

        $notification=array(
            'messege'=>'Successfully Cash Added',
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
