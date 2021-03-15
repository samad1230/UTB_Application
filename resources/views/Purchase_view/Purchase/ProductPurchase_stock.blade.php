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
                                        <div class="col-md-3">
                                            <div class="breadcome-heading">
                                                <form role="search" class="sr-input-func">
                                                    <input type="text" placeholder="Search Offer ID" class="search-int form-control" id="searchproduct">
                                                    <a href="#"><i class="search-icon text-muted i-Magnifi-Glass1"></i></a>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table" id="">
                                                <thead class="thead-dark">
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
                                        </div>
                                        <a href="#" class="btn btn-primary btn-md" target="_blank" style="float: right">Print</a>
                                    </div>
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

@endsection

    @section('pagescript')
        <script type="text/javascript">
            $('#searchproduct').on('keyup',function(){
                $value = $(this).val();
                $.ajax({
                    type : 'get',
                    url : '{{route('product.purcheshdata')}}',
                    data:{'search':$value},
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            })


            // $(document).on('click', '.product_view', function() {
            //     var product_id = $(this).closest('tr').find('td:eq(1)').text();
            //     $.ajax({
            //         type : 'GET',
            //         url : '/Product/Purchase/Details/'+product_id,
            //         success:function(data){
            //             location.href = '/Product/Purchase/Details/'+product_id;
            //         }
            //     });
            // })


        </script>
    @endsection
