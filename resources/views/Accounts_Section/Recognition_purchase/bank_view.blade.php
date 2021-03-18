@extends('Department_layouts.Accounts_master_layout')
@section('content')

    <style>
        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 10px;
        }
    </style>
    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')
                <div class="separator-breadcrumb border-top"></div>
                <section class="contact-list">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card text-left">
                                <div class="card-header text-right bg-transparent">
                                    <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#addaccount"><i class="i-Add-User text-white mr-2"></i> Add Accounts</button>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="ul-contact-list" style="width:100%">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Account Name</th>
                                                <th>Account No</th>
                                                <th>Bank Name</th>
                                                <th>Balance</th>
                                                <th>Deposit</th>
                                                <th>View</th>
                                                <th>Edit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php use App\Product_model\Purchase;$i=1;?>
                                            @foreach($accounts as $row)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$row->account_name}}</td>
                                                    <td>{{$row->account_no}}</td>
                                                    <td>{{$row->bank_name}}</td>
                                                    <td>{{$row->blanch}}</td>
                                                    <td><button type="button" class="btn btn-success btn-sm bank_deposit" id="{{$row->id}}" >Deposit</button></td>
                                                    <td>
                                                        <a href="{{route('Bank.show',$row->id)}}" class="btn btn-primary btn-sm" >view</a>
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-success btn-sm bank_edit" id="{{$row->id}}" >Edit</button>
                                                    </td>
                                                </tr>
                                                <?php $i++;?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addaccount" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Add Bank Accounts</h4>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('Bank.store') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Account Name">Account Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="account_name" class="form-control" placeholder="Account Name" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Account No</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="account_no" class="form-control" id="" placeholder="Account No" >
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Bank Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="bankname" class="form-control" id="" placeholder="Bank Name" >
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Blanch</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="prevcash" class="form-control" id="" placeholder="Blanch" >
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addaccount_edit" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Banks Accounts Update</h4>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="" class="editaccount_data" method="POST"  enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Account Name">Account Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="account_name" class="form-control" id="accountsname_edit" placeholder="Account Name" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Account No</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="account_no" class="form-control" id="accountno_edit" placeholder="Account No" >
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Bank Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="bankname" class="form-control" id="bankname_edit" placeholder="Bank Name" >
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Blanch</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="prevcash" class="form-control" id="balach_edit" placeholder="Blanch" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="bankdeposit" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Banks Cash Deposit</h4>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="" class="deposit_data" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="dataid" id="accountid">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Bank Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="" class="form-control" id="bankname_data" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Account Name">Account Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="" class="form-control" id="accountsname_data" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Account No</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="" class="form-control" id="accountno_data" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Previous Blanch</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="previous_cash" class="form-control" id="balach_pre" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Deposit Cash</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="depositcash" class="form-control" id="deposit_cash" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Last Blanch</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="lastcash" class="form-control" id="last_cash" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('pagescript')


    <script>
        $(function() {
            $(document).on("click", ".bank_edit", function(e){
                e.preventDefault();
                var bankid = $(this).attr('id');
                $.ajax({
                    type: 'GET',
                    url:'/Bank/'+bankid+'/edit',
                    success: function (data) {

                        $("#accountsname_edit").val(data.account_name);
                        $("#accountno_edit").val(data.account_no);
                        $("#bankname_edit").val(data.bank_name);
                        $("#balach_edit").val(data.blanch);
                        $('.editaccount_data').attr('action', '/Bank/'+bankid);
                    }
                });
                $("#addaccount_edit").modal('show');

            });

            $(document).on("click", ".bank_deposit", function(e){
                e.preventDefault();
                var bankid = $(this).attr('id');
                $.ajax({
                    type: 'GET',
                    url:'/Bank_accountdata/'+bankid,
                    success: function (data) {

                        $("#bankname_data").val(data.bank_name);
                        $("#accountsname_data").val(data.account_name);
                        $("#accountno_data").val(data.account_no);
                        $("#balach_pre").val(data.balanch);
                        $("#accountid").val(bankid);

                        $('#deposit_cash').on('change', function(){
                            var deposit_cash = $("#deposit_cash").val();
                            var lastcashdepost = parseFloat(deposit_cash) + parseFloat(data.balanch);
                            $('#last_cash').val(lastcashdepost);
                        });

                        $('.deposit_data').attr('action', '/Bank_deposit/'+bankid);
                    }
                });
                $("#bankdeposit").modal('show');
            });
        });
    </script>



@endsection


