@extends('Department_layouts.Accounts_master_layout')
@section('content')

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')

                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive m-b-40">
                                <table class="table table-striped table-data3 data-table1">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Recognition</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Supplier</th>
                                        <th>Update</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sl = 1; ?>
                                        @foreach ($recognition_item as $row)
                                            <tr>
                                                <td>{{ $sl}}</td>
                                                <td>{{ $row->Recognition->date}}</td>
                                                <td>{{ $row->Recognition->recognition_no}}</td>
                                                <td>{{ $row->product->name}}</td>
                                                <td>{{ $row->quantity}}</td>
                                                @php
                                                    if ($row->lcpurchase != null){
                                                        $type = "LC Purchase";
                                                        $amount=$row->lcpurchase->amount;
                                                        $supplier=$row->lcpurchase->supplier->company_name;
                                                        $lcorlocalid =$row->lcpurchase->id;
                                                     }else if (($row->localpurchase != null)){
                                                        $type = "Local Purchase";
                                                        $amount=$row->localpurchase->amount;
                                                        $supplier=$row->localpurchase->supplier->company_name;
                                                        $lcorlocalid =$row->localpurchase->id;
                                                     }else{
                                                        $type = "";
                                                        $amount="";
                                                     }
                                                @endphp
                                                <td>{{ $type}}</td>
                                                <td>{{ $amount}}</td>
                                                <td>{{$supplier}}</td>
                                                <?php
                                                    if ($row->product_status==1){
                                                       ?>
                                                <td><button type="button" class="btn btn-success btn-sm purchaseapprove_model" id="{{$row->id}}" >Update</button></td>
                                                <?php
                                                    }else{
                                                      ?>
                                                <td><button type="button" class="btn btn-primary btn-sm" >Done</button></td>
                                                    <?php
                                                    }
                                                ?>


                                            </tr>
                                            <?php $sl++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="recognition_edit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Accounts Purchase Update</h4>
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
                    <form action="{{route('purchase_accounts_cost_analysis')}}" class="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="rec_itemid" name="rec_item_id">
                        <input type="hidden" id="purchase_id" name="purchaseid">
                        <input type="hidden" id="supplier_iddata" name="supplier_id">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="" for="">Product name :</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="product_name" class="form-control" id="productname" placeholder="Product Name" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="" for="">Recognition NO :</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="recognitionID" class="form-control" id="recognition_ID" placeholder="Recognition ID" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="" for="">Quantity :</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="Quantity" class="form-control" id="Quantity_edit" placeholder="Quantity" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="" for="">Supplier :</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="supplier" class="form-control" id="supplier_data" placeholder="Supplier" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="" for="">Purchase Type :</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="purchase_type" class="form-control" id="purchase_type_data" placeholder="Purchase Type" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="" for="">Amount :</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="amount" class="form-control" id="amount_data" placeholder="Amount" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="" for="">Expense :</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="expense" class="form-control" id="expense_data" placeholder="Expense">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="" for="">Discount :</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="discount" class="form-control" id="discount_data" placeholder="Discount">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="" for="">Actual Amount :</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="total_amount" class="form-control" id="total_amount_data" placeholder="Actual Amount" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="" for="">Disburse Date :</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="date" name="disburse_date" class="form-control" id="" placeholder="Disburse Date" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('pagescript')
    <script>
        $(function(){
            $('.purchaseapprove_model').on('click', function(){
                var editid = $(this).attr("id");

                $.ajax({
                    type: 'GET',
                    url:'/purchaseapprove_data/'+editid,
                    success: function (data) {
                        //console.log(data);
                        $("#recognition_no").val(data.recognition_no);
                        $("#rec_itemid").val(data.id);
                        $("#productname").val(data.product);
                        $("#recognition_ID").val(data.recognition_no);
                        $("#Quantity_edit").val(data.quantity);
                        $("#supplier_data").val(data.supplier);
                        $("#purchase_type_data").val(data.Purchase_Type);
                        $("#amount_data").val(data.amount);
                        $("#purchase_id").val(data.purchase_id);
                        $("#supplier_iddata").val(data.supplier_id);
                    }
                });

                $("#recognition_edit").modal('show');

            });

            $('#expense_data').on('change', function(){
                var expense_data = $("#expense_data").val();
                var amount_data = $("#amount_data").val();
                var discount_data = $("#discount_data").val();

                if (discount_data==null){
                    var disc = 0;
                }else{
                    var disc = discount_data;
                }

                var totalamount = parseFloat(amount_data) + parseFloat(expense_data);
                var actualamount = totalamount - disc;
                $("#total_amount_data").val(actualamount);

            });

            $('#discount_data').on('change', function(){
                var discount_data = $("#discount_data").val();
                var expense_data = $("#expense_data").val();
                var amount_data = $("#amount_data").val();

                if (expense_data==null){
                    var expense = 0;
                }else{
                    var expense = expense_data;
                }

                var totalamount = parseFloat(amount_data) + parseFloat(expense);
                var actualamount = totalamount - discount_data;
                $("#total_amount_data").val(actualamount);

            });

        });
    </script>
@endsection

