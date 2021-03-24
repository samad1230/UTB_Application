@extends('Department_layouts.Sales_master_layout')
@section('content')

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')

                <div class="inbox-main-sidebar-container" data-sidebar-container="main">
                    <div class="inbox-main-content" data-sidebar-content="main">
                        <div class="inbox-secondary-sidebar-container box-shadow-1" data-sidebar-container="secondary">
                            <div data-sidebar-content="secondary">
                                <div class="inbox-secondary-sidebar-content position-relative">
                                    <div class="inbox-details perfect-scrollbar rtl-ps-none" data-suppress-scroll-x="true">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Product</th>
                                                    <th>Details</th>
                                                    <th>Brand</th>
                                                    <th>Reference</th>
                                                    <th>Popular</th>
                                                    <th>Feature</th>
                                                    <th>Update</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $sl = 1; ?>
                                                @foreach ($product as $row)
                                                    <tr>
                                                        <td>{{$sl}}</td>
                                                        <td>{{ $row->name }}</td>
                                                        <td>{{ $row->product_details }}</td>
                                                        <td>
                                                            @foreach($row->brands as $brand)
                                                                {{$brand->name}}
                                                            @endforeach

                                                        </td>
                                                        <td>{{ $row->skvalue }}</td>
                                                        @php
                                                            if ($row->popular_product==1){
                                                                $popular = "Active";
                                                            }else{
                                                                $popular = "No Active";
                                                            }
                                                            if ($row->feature_product==1){
                                                                $feature = "Active";
                                                            }else{
                                                                $feature = "No Active";
                                                            }
                                                        @endphp
                                                        <td>{{ $popular }}</td>
                                                        <td>{{ $feature }}</td>
                                                        <td>
                                                            <a href="{{route('sell_product.edit',$row->slag)}}" class="btn btn-primary btn-sm"> Edit</a>
                                                        </td>
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
            </div>
        </div>
    </div>

@endsection

