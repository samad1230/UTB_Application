@extends('Department_layouts.Purchese_master_layout')
@section('content')

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')

                <div class="inbox-main-sidebar-container" data-sidebar-container="main">
                    <div class="inbox-main-content" data-sidebar-content="main">
                        <div class="inbox-secondary-sidebar-container box-shadow-1" data-sidebar-container="secondary">
                            <div data-sidebar-content="secondary">
                                <div class="inbox-secondary-sidebar-content position-relative" style="min-height: 500px">
                                    <div class="inbox-details perfect-scrollbar rtl-ps-none" data-suppress-scroll-x="true">
                                        <form action="" method="POST"  enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
                                            @csrf

                                            <input type="hidden" name="" id="suplier_status">
                                            <input type="hidden" name="" id="suplier_accounts">
                                            <input type="hidden" name="" id="productname">
                                            <input type="hidden" name="" id="checkvalchange">



                                            <div class="row rowpad">
                                                <div class="col-md-5">
                                                    <div class="form-group row">
                                                        <div class="col-md-5" style="text-align: right;">
                                                            <label class="form-control-label">Supplier Name : <span class="tx-danger" > *</span></label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="suplier_id" id="suplier_iddata" required>
                                                                <option value="">Select Supplier</option>
                                                                @foreach ($supplier as $data)
                                                                    <option value="{{$data->id}}">{{$data->company_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-1">

                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group row">
                                                        <div class="col-md-5" style="text-align: right;">
                                                            <label class="form-control-label">Sale Date : <span class="tx-danger"> *</span></label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <?php  use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Cache;$n_dat= date("Y-m-d"); ?>
                                                            <input type="date" class="form-control" name="sale_date" id="sellingdate" value="{{$n_dat}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                            </div>

                                            <div class="row rowpad">
                                                <div class="col-md-3">
                                                    <label class="form-control-label">Product Name <span class="tx-danger"> *</span></label>
                                                    <select class="form-control select2" name="productid" id="product_id" required>
                                                        <option value="">Select Product</option>
                                                        @foreach ($product as $data)
                                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-control-label">Product Quantity <span class="tx-danger"> *</span></label>
                                                    <input class="form-control" type="text" name="quantity"  placeholder="Product Quantity" required="" id="quantity_valu" autocomplete="off" >
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-control-label">Buy Price <span class="tx-danger"> *</span></label>
                                                    <input class="form-control" type="text" name="buy_price"  placeholder="Buy Price" required="" id="buypriceval" autocomplete="off" >
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-control-label">Total Amount</label>
                                                    <input class="form-control" type="text" name="total_buy_price"  placeholder="Total Buy Amount" id="totalbuyamount" disabled="">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-control-label">Sell Price <span class="tx-danger"> *</span></label>
                                                    <input class="form-control" type="text" name="sell_price"  placeholder="Selling Price" required="" id="sellpriceval"  autocomplete="off" >
                                                </div>
                                                <div class="col-lg-1" style="margin-top: 32px;">
                                                    <button type="button" id="addbutton" class="glyphicon glyphicon-plus btn-primary btn-sm " aria-label=""> +
                                                    </button>
                                                </div>

                                            </div>


                                            <div class="row rowpad">
                                                <div class="col-md-8">
                                                    <div class="col-xs-12 table-responsive">
                                                        <table class="table table-striped table-bordered" id="item_list">
                                                            <thead class="thead-dark">
                                                            <tr>
                                                                <th>SL</th>
                                                                <th>Product</th>
                                                                <th>Quantity</th>
                                                                <th>Buy Price </th>
                                                                <th>Total Buy</th>
                                                                <th>Sell Price</th>
                                                                <th>Remove</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="accountsection">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group-inner">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="login2 pull-right pull-right-pro">Total Buy :</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="text" class="form-control" id="purchase_amount_total" disabled="" style="font-weight: bold" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group-inner">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="login2 pull-right pull-right-pro" >Purchase Cost :</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="text" class="form-control" name="labercost" id="purchase_cost" style="font-weight: bold" autocomplete="off" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group-inner">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="login2 pull-right pull-right-pro" >Net Payable : </label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="text" class="form-control" id="payable_amount" disabled="" style="font-weight: bold" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group-inner">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="login2 pull-right pull-right-pro" >Discount :</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="text" class="form-control" name="discountflat" id="discount_flat" style="font-weight: bold" autocomplete="off" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group-inner">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="login2 pull-right pull-right-pro">Actual Purchase :</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="text" class="form-control" name="subtotal_cash" id="actual_purchase_amount" style="font-weight: bold" disabled/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group-inner">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="login2 pull-right pull-right-pro" >Supplier Payment :</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="text" class="form-control" name="cash_payment" id="supplier_payment" style="font-weight: bold" autocomplete="off" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group-inner">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="login2 pull-right pull-right-pro" >Previous Account :</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="text" class="form-control" id="previus_account" disabled="" style="font-weight: bold"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group-inner">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="login2 pull-right pull-right-pro" >Last Blanch :</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="text" class="form-control" id="last_balanch" disabled="" style="font-weight: bold;color: red;" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group-inner">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="login2 pull-right pull-right-pro" >Include Cost :</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="checkbox" class="form-check-input" id="checkval" name="buy_include" value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="form-actions text-center">
                                            <button class="btn btn-primary pull-center" id="purchese_submit_btn" >Submit</button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive m-b-40">
                                            <table class="table table-striped table-data3 data-table1">
                                                <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Date</th>
                                                    <th>Offer Id</th>
                                                    <th>Supplier</th>
                                                    <th>Buy Amount</th>
                                                    <th>Buy Cost</th>
                                                    <th>Discount</th>
                                                    <th>Total Buy</th>
                                                    <th>Payment</th>
                                                    <th>Blanch</th>
                                                    <th>View</th>

                                                    <?php
                                                    $userid = Auth::user()->id;
                                                    if (Auth::user()->role_id == 1){
                                                    ?>
                                                    <th>Delete</th>
                                                    <?php

                                                    }
                                                    ?>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php $sl = 1; ?>
                                                @foreach ($productstokedata as $row)
                                                    <tr>
                                                        <td>{{ $sl}}</td>
                                                        <td>{{ $row->purchase_date}}</td>
                                                        <td>{{ $row->offer_id}}</td>
                                                        <td>{{ $row->supplier->company_name}}</td>
                                                        <td>{{ $row->total_buy_amount}}</td>
                                                        <td>{{ $row->total_buy_cost}}</td>
                                                        <td>{{ $row->total_buy_discount}}</td>
                                                        <td>{{ $row->last_buy_amount}}</td>
                                                        <td>{{ $row->payment_amount}}</td>
                                                        <td>{{ $row->last_buy_amount - $row->payment_amount}}</td>
                                                        <td><a href="{{route('purchesedetail.view',$row->offer_id)}}" class="btn-primary btn-sm"> View</a></td>

                                                        <?php
                                                        $userid = Auth::user()->id;
                                                        if (Auth::user()->role_id == 1){
                                                        ?>
                                                        <td><a class="btn btn-danger btn-sm" href="#" id="delete" role="button">Delete</a></td>
                                                        <?php

                                                        }
                                                        ?>
                                                    </tr>
                                                    <?php $sl++; ?>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="text-center">
                                                {{ $productstokedata->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('pagescript')

    <script src="{{ asset('js/Product/purchase.js') }}"></script>

@endsection
