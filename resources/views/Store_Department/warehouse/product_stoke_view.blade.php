@extends('Department_layouts.Store_master_layout')
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
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="" style="width:100%">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Purchase</th>
                                                <th>Type</th>
                                                <th>Product</th>
{{--                                                <th>Price</th>--}}
                                                <th>Quantity</th>
{{--                                                <th>Total Price</th>--}}
                                                <th>Supplier</th>
                                                <th>Stoke Date</th>
                                                <th>Make By</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php use App\Product_model\Purchase;$i=1;?>
                                            @foreach($product as $row)
                                                @php
                                                    $type = \App\Recognition_model\Purchase_Type::where('id',$row->purchase_type)->first();
                                                @endphp
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$row->purchase_date}}</td>
                                                    <td>{{$type->purchase_type}}</td>
                                                    <td>{{$row->product->name}}</td>
{{--                                                    <td>{{round($row->single_buy_price)}}</td>--}}
                                                    <td>{{$row->quantity}}</td>
{{--                                                    <td>{{round($row->total_buy)}}</td>--}}
                                                    <td>{{$row->supplier->company_name}}</td>
                                                    <td>{{$row->stoke_in_date}}</td>
                                                    <td>{{$row->user->name}}</td>
                                                    <?php
                                                    if ($row->status==0){
                                                    ?>
                                                    <td><button type="button" class="btn btn-warning btn-sm store_added" id="{{$row->id}}" >Wetting</button></td>
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <td><a  class="btn btn-success btn-sm"> Done</a></td>
                                                    <?php
                                                    }
                                                    ?>

                                                </tr>
                                                <?php $i++;?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        {{ $product->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="StoreProductUpdate" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Store Update Product</h4>
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

                    <form action="" class="warehouse_update" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
{{--                        <input type="hidden" name="id" id="productid">--}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Product Name :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="product_name" class="form-control" id="productname" placeholder="Product Name" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Quantity :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="Quantity" class="form-control" id="Quantity_edit" placeholder="Quantity" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Store In Date :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" name="indate" class="form-control"  placeholder="Store In Date" required>
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
            $('.store_added').on('click', function(){
                var storeid = $(this).attr("id");
                $.ajax({
                    type: 'GET',
                    url:'/storeproduct_id/'+storeid,
                    success: function (data) {
                        $("#productid").val(data.id);
                        $("#productname").val(data.product);
                        $("#Quantity_edit").val(data.quantity);
                        $('.warehouse_update').attr('action', '/Warehouse/'+storeid);
                    }
                });

                $("#StoreProductUpdate").modal('show');

            });

        });
    </script>
@endsection
