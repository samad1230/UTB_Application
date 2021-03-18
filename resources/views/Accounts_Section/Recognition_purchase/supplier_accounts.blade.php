@extends('Department_layouts.Accounts_master_layout')
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
                                        <div class="table-responsive">
                                            <table class="table" id="ul-contact-list">
                                                <thead class="table-dark">
                                                <tr>
                                                    <th>SL</th>
                                                    <th>ID</th>
                                                    <th>Company</th>
                                                    <th>Person</th>
                                                    <th>Purchase</th>
                                                    <th>Payment</th>
                                                    <th>Blanch</th>
                                                    <th>Status</th>
                                                    <th>Payment</th>
                                                    <th>Details</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $sl = 1; ?>
                                                    @foreach($accountsdata as $row )
                                                        @php
                                                            $blanch = $row['purchase_amount'] - $row['payment'];
                                                            if ($blanch > 0){
                                                               $status = "Due";
                                                            }else if ($blanch < 0){
                                                               $status = "Advance";
                                                            }else if ($blanch == 0){
                                                               $status = "Paid";
                                                            }
                                                        @endphp
                                                    <tr>
                                                        <td>{{$sl}}</td>
                                                        <td>{{$row['id']}}</td>
                                                        <td>{{$row['company_name']}}</td>
                                                        <td>{{$row['person_name']}}</td>
                                                        <td>{{$row['purchase_amount']}}</td>
                                                        <td>{{$row['payment']}}</td>
                                                        <td>{{$row['purchase_amount'] - $row['payment']}}</td>
                                                        <td>{{$status}}</td>
                                                        <td><a href="{{route('supplier_payment_view',$row['id'])}}" class="btn btn-primary btn-sm" >Payment</a></td>
                                                        <td><button type="button" class="btn btn-success btn-sm" id="" >Details</button></td>
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

@section('pagescript')



@endsection
