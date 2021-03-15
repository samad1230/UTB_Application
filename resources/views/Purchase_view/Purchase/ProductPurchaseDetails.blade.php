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
                                        <section class="contact-list">

                                            <div class="row">
                                                <div class="col-md-12 mb-4">

                                                    <a href="" class="btn-success btn-sm" style="float: right; color: #f7f7ff; margin-right: 20px;" target="_blank">Print</a>
{{--                                                    $singlePurchase--}}
{{--                                                    $previus_offerid--}}
{{--                                                    $last_offerid--}}
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div>
                                                                <strong>Supplier</strong>
                                                            </div>
                                                            ------------------------
                                                            <div><strong> Name :  </strong>{{$singlePurchase->supplier->company_name}}</div>

                                                            <div><strong>Previous Blanch : </strong> </div>
                                                            <div><strong>Last Blanch : </strong>  </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div><a class="btn btn-primary" href="" role="button">Back</a>	&nbsp;	&nbsp;
                                                                <a class="btn btn-primary" href="" role="button">Next</a></div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div>
                                                                <strong>Last Invoice ()</strong>
                                                            </div>

                                                            ------------------------
                                                            <div><strong>Buy Amount : </strong>  </div>
                                                            <div><strong>Discount : </strong> </div>
                                                            <div><strong>Cost Amount : </strong> </div>
                                                            <div><strong>Actual Buy : </strong> </div>
                                                            <div><strong>Invoice Payment : </strong> </div>
                                                            <div><strong>Blanch : </strong> </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-data3 data-table1">
                                                                <thead>
                                                                <tr>
                                                                    <th>SL</th>
                                                                    <th>Product</th>
                                                                    <th>Code</th>
                                                                    <th>Symbol</th>
                                                                    <th>Quantity</th>
                                                                    <th>Buy</th>
                                                                    <th>Cost</th>
                                                                    <th>Discount</th>
                                                                    <th>Payable</th>
                                                                    <th>Sell price</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>


                                                                <tr>
                                                                    <td colspan="7" style="font-size: 14px; font-weight: bold; text-align: right;" class="allbuy"> </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>


                                                </div>
                                            </div>
                                        </section>
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
