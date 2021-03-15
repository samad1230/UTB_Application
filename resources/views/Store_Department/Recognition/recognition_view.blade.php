@extends('Department_layouts.Store_master_layout')
@section('content')

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')

                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="productname">

                                <div class="row rowpad">
                                    <div class="col-md-4">
                                        <div class="row rowpad">
                                            <div class="col-md-12">
                                                <label class="form-control-label">Recognition Date <span class="tx-danger"> *</span></label>
                                                <?php  use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Cache;$n_dat= date("Y-m-d"); ?>
                                                <input type="date" class="form-control form-control-rounded" name="" id="reco_date" value="{{$n_dat}}" required>
                                            </div>
                                        </div>
                                        @php
                                            $x = '0123456789';
                                            $x = str_shuffle($x);
                                            $reco_num = "R".substr($x, 0, 5);
                                        @endphp
                                        <div class="row rowpad">
                                            <div class="col-md-12">
                                                <label class="form-control-label">Recognition Number <span class="tx-danger"> *</span></label>
                                                <input type="text" class="form-control form-control-rounded" name="" id="recognition_number" value="{{$reco_num}}" placeholder="Recognition Number"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="row rowpad">
                                            <div class="col-md-5">
                                                <label class="form-control-label">Product Name <span class="tx-danger"> *</span></label>
                                                <select class="form-control select2" name="productid" id="product_id" required>
                                                    <option value="">Select Product</option>
                                                    @foreach ($product as $data)
                                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-control-label">Product Quantity <span class="tx-danger"> *</span></label>
                                                <input class="form-control" type="text" name="quantity"  placeholder="Product Quantity" required="" id="quantity_valu" autocomplete="off" >
                                            </div>

                                            <div class="col-lg-2" style="margin-top: 32px;">
                                                <button type="button" id="addbutton" class="glyphicon glyphicon-plus btn-primary btn-sm " aria-label=""> +
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row rowpad">
                                            <div class="col-xs-12 table-responsive">
                                                <table class="table table-striped table-bordered text-center" id="item_list">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th>Remove</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="form-actions text-center">
                                <button class="btn btn-primary pull-center" id="recognition_submit_btn" >Submit </button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive m-b-40">
                                <table class="table table-striped table-data3 data-table1">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Recognition</th>
                                        <th>Date</th>
                                        <th>Total Item</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $sl = 1; ?>
                                    @foreach ($Recognition as $row)
                                        @php
                                            $item = \App\Recognition_model\Recognition_item::where('recognition_id',$row->id)->get();

                                        @endphp
                                        <tr>
                                            <td>{{ $sl}}</td>
                                            <td>{{ $row->recognition_no}}</td>
                                            <td>{{ $row->date}}</td>
                                            <td>{{ count($item)}}</td>
                                            <?php
                                            if ($row->status==0){
                                            ?>
                                            <td><a  class="btn-warning btn-sm"> Pending</a></td>
                                            <?php
                                            }else if($row->status==1){
                                            ?>
                                            <td><a  class="btn-success btn-sm">Purchase Approve</a></td>
                                            <?php
                                            }else if($row->status==2){
                                            ?>
                                            <td><a  class="btn-danger btn-sm"> Dis-Approved</a></td>
                                            <?php
                                            }else{
                                            ?>
                                            <td><a  class="btn-danger btn-sm"> All Approved</a></td>
                                            <?php
                                            }
                                            ?>
                                            <td><a href="{{route('Recognition.show',$row->id)}}" class="btn-primary btn-sm"> View</a></td>
                                        </tr>
                                        <?php $sl++; ?>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    {{ $Recognition->links() }}
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
    <script src="{{ asset('js/Product/recognition.js') }}"></script>
@endsection

