@extends('Department_layouts.Accounts_master_layout')
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

                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-control-label">Product Quantity <span class="tx-danger"> *</span></label>
                                                <input class="form-control" type="text" name="quantity"  placeholder="Product Quantity" required="" id="quantity_valu" autocomplete="off" >
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="form-actions text-center">
                                <button class="btn btn-primary pull-center" id="recognition_submit_btn" >Submit </button>
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

