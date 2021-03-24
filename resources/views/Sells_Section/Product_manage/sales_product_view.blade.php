@extends('Department_layouts.Sales_master_layout')
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
                                                <th>Date</th>
                                                <th>Supplier</th>
                                                <th>Product</th>
                                                <th>Buy Price</th>
                                                <th>Quantity</th>
                                                <th>Sell Price</th>
                                                <th>Discount Price</th>
                                                <th>Rest Qty</th>
                                                <th>Update By</th>
                                                <th>Status</th>
                                                <th>Pricing</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1;?>
                                            @foreach($productdata as $row)

                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$row->stoke_date}}</td>
                                                    <td>{{$row->supplier->company_name}}</td>
                                                    <td>{{$row->product->name}}</td>
                                                    <td>{{round($row->buy_price)}}</td>
                                                    <td>{{$row->buy_qty}}</td>
                                                    <td>{{$row->sell_price}}</td>
                                                    <td>{{$row->sell_discount_price}}</td>
                                                    <td>{{$row->rest_qty}}</td>
                                                    <td>{{$row->user->name}}</td>
                                                    <?php
                                                    if ($row->status==0){
                                                    ?>
                                                    <td><button type="button" class="btn btn-warning btn-sm" id="" >Stoke Out</button></td>
                                                    <td><button type="button" class="btn btn-primary btn-sm " >Pricing</button></td>
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <td><button type="button" class="btn btn-success btn-sm " id="" >Available</button></td>
                                                    <td><button type="button" class="btn btn-primary btn-sm pricing_update" id="{{$row->id}}" >Pricing</button></td>
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
                                        {{ $productdata->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ProductPriceUpdate" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Product Price Update</h4>
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

                    <form action="" class="price_update" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Product Name :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="" class="form-control" id="productname" placeholder="Product Name" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Buy Price :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="" class="form-control" id="buyprice" placeholder="Buy Price" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Quantity :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="" class="form-control" id="quantity_edit" placeholder="Quantity" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Sell Price :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="sellprice" class="form-control" id="sellprice_edit" placeholder="Sell Price">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Discount Price :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="discountprice" class="form-control" id="discountprice_edit" placeholder="Discount Price">
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
            $('.pricing_update').on('click', function(){
                var priceId = $(this).attr("id");
                $.ajax({
                    type: 'GET',
                    url:'/Sells/'+priceId+'/edit',
                    success: function (data) {
                       // console.log(data);

                        $("#productname").val(data.product_id);
                        $("#buyprice").val(data.buy_price);
                        $("#quantity_edit").val(data.buy_qty);
                        $("#sellprice_edit").val(data.sell_price);
                        $("#discountprice_edit").val(data.sell_discount_price);
                        $('.price_update').attr('action', '/Sells/'+priceId);

                    }
                });

                $("#ProductPriceUpdate").modal('show');

            });

        });
    </script>
@endsection
