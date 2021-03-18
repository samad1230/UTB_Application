@extends('Department_layouts.Accounts_master_layout')
@section('content')
    <style>
        .form-control-label {
            font-size: 15px;
            color: #07000e;
            margin-top: 2px;
            font-weight: bold;
            margin-left: 23px;
        }
    </style>

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')

                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="supplierid" value="{{$supplierpaymentdata['supplieriddata']}}">
                                <div class="row rowpad">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-6 rowpad">
                                                        <label class="form-control-label">Payment Date <span class="tx-danger"> *</span></label>
                                                        <?php  use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Cache;$n_dat= date("Y-m-d"); ?>
                                                        <input type="date" class="form-control form-control-rounded" name="paymentdate" id="reco_date" value="{{$n_dat}}" required>
                                                    </div>
                                                    <div class="col-md-6 rowpad">
                                                        <label class="form-control-label">Recognition Number <span class="tx-danger"> *</span></label>
                                                        <input type="text" class="form-control form-control-rounded" name="recognition_number" id="" value="{{$supplierpaymentdata['recognition_no']}}" placeholder="Recognition Number" readonly/>
                                                    </div>
                                                    <div class="col-md-6 rowpad">
                                                        <label class="form-control-label">Supplier <span class="tx-danger"> *</span></label>
                                                        <input type="text" class="form-control form-control-rounded" name="supplier" id="" value="{{$supplierpaymentdata['supplier_name']}}" placeholder="Supplier Name" readonly/>
                                                    </div>
                                                    <div class="col-md-6 rowpad">
                                                        <label class="form-control-label">Supplier Blanch <span class="tx-danger"> *</span></label>
                                                        <input type="text" class="form-control form-control-rounded" name="supplier_blanch" id="supplierblanch" value="{{$supplierpaymentdata['supplier_blanch']}}" placeholder="Supplier Blanch" readonly/>
                                                    </div>
                                                    <div class="col-md-4 rowpad">
                                                        <label class="form-control-label">Payment Type <span class="tx-danger"> *</span></label>
                                                        <select class="form-control form-control-rounded" name="paymenttype" id="payment_type">
                                                            <option value="">Select Payment Type</option>
                                                            <option value="1">Cash Payment</option>
                                                            <option value="2">Bank Payment</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 rowpad">
                                                        <label class="form-control-label">Payment To Bank <span class="tx-danger"> *</span></label>
                                                        <select class="form-control form-control-rounded" name="bank_id" id="bankdata_id">
                                                            <option value="">Select Bank</option>
                                                                @foreach($bankac as $row)
                                                                <option value="{{$row->id}}">{{$row->account_name}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 rowpad">
                                                        <label class="form-control-label">Bank Ac Blanch <span class="tx-danger"> *</span></label>
                                                        <input type="text" class="form-control form-control-rounded" name="bankacblanch" id="bankac_blanch" value="" placeholder="Bank Ac Blanch" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="col-md-12 rowpad">
                                                        <label class="form-control-label">Pay Amount <span class="tx-danger"> *</span></label>
                                                        <input type="text" class="form-control form-control-rounded" name="payamount" id="payment_amount" value="" placeholder="Pay Amount"/>
                                                    </div>
                                                    <div class="col-md-12 rowpad">
                                                        <label class="form-control-label">Check No<span class="tx-danger"> *</span></label>
                                                        <input type="text" class="form-control form-control-rounded" name="checkno" id="" value="" placeholder="Check No"/>
                                                    </div>
                                                    <div class="col-md-12 rowpad">
                                                        <label class="form-control-label">Check Date<span class="tx-danger"> *</span></label>
                                                        <input type="text" class="form-control form-control-rounded" name="checkdate" id="" value="" placeholder="Check Date"/>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-12 rowpad">
                                                    <label class="form-control-label">Document Upload <span class="tx-danger"> *</span></label>
                                                    <input type="file" class="form-control form-control-rounded" name="document"  />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-12 rowpad">
                                                    <label class="form-control-label">Payment Note <span class="tx-danger"> *</span></label>
                                                    <input type="text" class="form-control form-control-rounded" name="paymentdetails" id="" value="" placeholder="Payment Note"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions text-center">
                                    <button type="submit" class="btn btn-primary pull-center" id="" >Submit </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('pagescript')

@endsection

