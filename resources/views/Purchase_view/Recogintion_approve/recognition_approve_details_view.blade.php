@extends('Department_layouts.Purchese_master_layout')
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
                                        <th>Status</th>
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
                                                        $type = "Local Purchase";
                                                        $amount=$row->lcpurchase->amount;
                                                     }else if (($row->localpurchase != null)){
                                                        $type = "LC Purchase";
                                                        $amount=$row->localpurchase->amount;
                                                     }else{
                                                        $type = "";
                                                        $amount="";
                                                     }
                                                @endphp
                                                <td>{{ $type}}</td>
                                                <td>{{ $amount}}</td>



                                                <?php
                                                if ($row->product_status==0){
                                                ?>
                                                <td><a  class="btn btn-warning btn-sm"> Pending</a></td>
                                                <?php
                                                }else if($row->product_status==1){
                                                ?>
                                                <td><a  class="btn btn-success btn-sm"> Purchase Approve</a></td>
                                                <?php
                                                }else if($row->product_status==1){
                                                ?>
                                                <td><a  class="btn btn-danger btn-sm"> Dis-Approved</a></td>
                                                <?php
                                                }else{
                                                ?>
                                                <td><a  class="btn btn-danger btn-sm"> All Approved</a></td>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                    if ($row->product_status==0){
                                                       ?>
                                                <td><button type="button" class="btn btn-success btn-sm recogition_edit" id="{{$row->id}}" >Update</button></td>
                                                <?php
                                                    }else if($row->product_status==1){
                                                      ?>
                                                    <td><button type="button" class="btn btn-primary btn-sm" >Waiting</button></td>
                                                    <?php
                                                    }else if($row->product_status==2){
                                                    ?>
                                                    <td><button type="button" class="btn btn-primary btn-sm" >Closed</button></td>
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <td><button type="button" class="btn btn-success btn-sm" >Done</button></td>
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
                    <h4 class="modal-title" id="">Recognition  Price Update</h4>
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
                    <form action="{{route('recognition_price.update')}}" class="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="recognition_no" name="recognitionno">
                        <input type="hidden" id="rec_itemid" name="rec_item_id">

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
                                            <input type="text" name="recognitionID" class="form-control" id="recognition_ID" placeholder="Recognition ID" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="" for="">Quantity :</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="Quantity" class="form-control" id="Quantity_edit" placeholder="Quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="" for="">Supplier :</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="supplier_id" id="" required >
                                                <option value="">Select Supplier</option>
                                                @foreach($supplier as $data)
                                                    <option value="{{$data->id}}">{{$data->company_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="" for="">Recognition Status :</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="status" id="statusdata" required >
                                                <option value="">Select Status</option>
                                                <option value="1">Approved</option>
                                                <option value="2">Dis-Approved</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="extraform">

                                </div>
                                <div class="lcnumber">

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
        $(function(){
            $('.recogition_edit').on('click', function(){
                var editid = $(this).attr("id");

                $.ajax({
                    type: 'GET',
                    url:'/recognition_edit/'+editid,
                    success: function (data) {
                        $("#recognition_no").val(data.recognition_no);
                        $("#rec_itemid").val(data.id);
                        $("#productname").val(data.product);
                        $("#recognition_ID").val(data.recognition_no);
                        $("#Quantity_edit").val(data.quantity);
                         $('.recognition_update').attr('action', '/Recognition/'+editid);
                    }
                });

                $("#recognition_edit").modal('show');

            });



            $('#statusdata').on('change', function(){
                var statusval = $("#statusdata").val();

                if (statusval==1){
                    $('.extraform').empty().append('<div class="modal-body">\n' +
                        '                            <div class="row">\n' +
                        '                                <div class="col-md-6">\n' +
                        '                                    <label class="" for="">Purchase Type :</label>\n' +
                        '                                </div>\n' +
                        '                                <div class="col-md-6">\n' +
                        '                                    <select class="form-control" name="producttype" id="producttype_val" required>\n' +
                        '                                        <option value="">Select Type</option>\n' +
                        '                                        @foreach($producttype as $type)\n' +
                        '                                            <option value="{{$type->purchase_type}}">{{$type->purchase_type}}</option>\n' +
                        '                                        @endforeach\n' +
                        '                                    </select>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                        </div>\n' +
                        '                        <div class="modal-body">\n' +
                        '                            <div class="row">\n' +
                        '                                <div class="col-md-6">\n' +
                        '                                    <label class="" for="">Price :</label>\n' +
                        '                                </div>\n' +
                        '                                <div class="col-md-6">\n' +
                        '                                    <input type="text" name="price" class="form-control" id="" placeholder="Recognition Price" autocomplete="off">\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                        </div>');

                    $('#producttype_val').on('change', function() {
                        var producttypeval = $("#producttype_val").val();

                        if (producttypeval=="LC Purchase"){
                            $('.lcnumber').empty().append('<div class="modal-body">\n' +
                                '                                <div class="row">\n' +
                                '                                    <div class="col-md-6">\n' +
                                '                                        <label class="" for="">Offer No :</label>\n' +
                                '                                    </div>\n' +
                                '                                    <div class="col-md-6">\n' +
                                '                                        <input type="text" name="offer_no" class="form-control" id="Quantity_edit" placeholder="Offer No" autocomplete="off">\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '                            </div>');
                        }else{
                            $('.lcnumber').empty().append('<div class="modal-body">\n' +
                                '                                <div class="row">\n' +
                                '                                    <div class="col-md-6">\n' +
                                '                                        <label class="" for="">Invoice No :</label>\n' +
                                '                                    </div>\n' +
                                '                                    <div class="col-md-6">\n' +
                                '                                        <input type="text" name="invoice_no" class="form-control" id="Quantity_edit" placeholder="Invoice No" autocomplete="off">\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '                            </div>');
                        }
                    });
                }else{
                    $('.extraform').empty().append('');
                    $('.lcnumber').empty().append('');
                }
            });



        });
    </script>
@endsection

