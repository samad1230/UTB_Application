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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h3 style="padding: 14px">Cash Blanch : <span><b style="color: blue;  font-weight: bold;">{{$cashbalanch->blanch}}</b></span></h3>
                                            </div>
                                            <div class="col-md-4">

                                            </div>
                                            <div class="col-md-4">
                                                <div class="card-header text-right bg-transparent">
                                                    <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#cashadd"><i class="i-Add-User text-white mr-2"></i> Add Cash</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="ul-contact-list" style="width:100%">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Cash Title</th>
                                                <th>Details</th>
                                                <th>Receipt</th>
                                                <th>Windrow</th>
                                                <th>Blanch</th>
                                                <th>Make By</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php use App\Product_model\Purchase;$i=1;?>
                                            @foreach($blanch as $row)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$row->date}}</td>
                                                    <td>{{$row->cash_title}}</td>
                                                    <td>{{$row->cash_details}}</td>
                                                    <td>{{$row->receipt}}</td>
                                                    <td>{{$row->decrypt}}</td>
                                                    <td>{{$row->blanch}}</td>
                                                    <td>{{$row->user->name}}</td>
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


    <div class="modal fade" id="cashadd" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Include Cash For Accounts</h4>
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
                    <form action="{{ route('CashBlanch.store') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="last_blanch_store">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Account Name">Cash Title</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="title" id="cashtitle" required>
                                        <option value="">Select Type</option>
                                        <option value="Investment">Investment</option>
                                        <option value="Bank Windrow">Bank Windrow</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="extraformdata">

                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Cash amount</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="receipt" class="form-control" id="cashrecipt" placeholder="Cash amount" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Details</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="details" class="form-control" id="" placeholder="Details" required>
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
            $('#cashtitle').on('change', function() {
                var cashtitle = $("#cashtitle").val();

                if (cashtitle=="Bank Windrow"){
                    $('.extraformdata').empty().append('<div class="extraform">\n' +
                        '                            <div class="modal-body">\n' +
                        '                                <div class="row">\n' +
                        '                                    <div class="col-md-4">\n' +
                        '                                        <label class=" " for="Address">Bank</label>\n' +
                        '                                    </div>\n' +
                        '                                    <div class="col-md-8">\n' +
                        '                                        <select class="form-control" name="bank_id" id="bank_iddata" required>\n' +
                        '                                            <option value="">Select Bank</option>\n' +
                        '                                            @foreach($bank as $row)\n' +
                        '                                                <option value="{{$row->id}}">{{$row->account_name."-".$row->bank_name}}</option>\n' +
                        '                                            @endforeach\n' +
                        '                                        </select>\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="modal-body">\n' +
                        '                                <div class="row">\n' +
                        '                                    <div class="col-md-4">\n' +
                        '                                        <label class=" " for="Address">Bank Blanch</label>\n' +
                        '                                    </div>\n' +
                        '                                    <div class="col-md-8">\n' +
                        '                                        <input type="text" name="blanch_bank" class="form-control" id="last_blanch" placeholder="Bank Blanch" readonly>\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                        </div>');

                    $('#bank_iddata').on('change', function() {
                        var bankid = $("#bank_iddata").val();
                        $.ajax({
                            type: 'GET',
                            url:'/Bank_account_blanch/'+bankid,
                            success: function (data) {
                                $("#last_blanch").val(data.blanch);
                                $("#last_blanch_store").val(data.blanch);
                            }
                        });
                    });

                    $('#cashrecipt').on('change',function () {
                        var cash = $('#cashrecipt').val();
                        var blanch = $('#last_blanch_store').val();
                        var  cashnew = parseInt(cash);
                        var  blanchnew = parseInt(blanch);

                        if (blanchnew < cashnew){
                           alert("Check Cash receipt") ;
                            $('#cashrecipt').val('');
                        }

                    });

                }else{
                    $('.extraformdata').empty().append();
                }





            });

        });
    </script>



@endsection


