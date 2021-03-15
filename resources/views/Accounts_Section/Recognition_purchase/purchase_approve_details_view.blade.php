@extends('Department_layouts.Accounts_master_layout')
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
                                        <th>Supplier</th>
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
                                                        $supplier=$row->lcpurchase->supplier->company_name;
                                                     }else if (($row->localpurchase != null)){
                                                        $type = "LC Purchase";
                                                        $amount=$row->localpurchase->amount;
                                                        $supplier=$row->localpurchase->supplier->company_name;
                                                     }else{
                                                        $type = "";
                                                        $amount="";
                                                     }
                                                @endphp
                                                <td>{{ $type}}</td>
                                                <td>{{ $amount}}</td>
                                                <td>{{$supplier}}</td>
                                                <?php
                                                    if ($row->product_status==1){
                                                       ?>
                                                <td><a href="{{route('accounts_cost_analysis',$row->id)}}" class="btn-primary btn-sm">Update</a></td>
                                                <?php
                                                    }else{
                                                      ?>
                                                <td><button type="button" class="btn btn-primary btn-sm" >Done</button></td>
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

@endsection


@section('pagescript')

@endsection

