@extends('Department_layouts.Accounts_master_layout')
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
                                        <table class="table" id="ul-contact-list" style="width:100%">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Account Name</th>
                                                <th>Bank Name</th>
                                                <th>Deposit</th>
                                                <th>Purpose</th>
                                                <th>Withdraw</th>
                                                <th>Blanch</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php use App\Product_model\Purchase;$i=1;?>
                                            @foreach($accountdetails as $row)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$row->date}}</td>
                                                    <td>{{$row->bank->account_name}}</td>
                                                    <td>{{$row->bank->bank_name}}</td>
                                                    <td>{{$row->deposit}}</td>
                                                    <td>{{@$row->bankTransactions->purpose}}</td>
                                                    <td>{{$row->withdraw}}</td>
                                                    <td>{{$row->blanch}}</td>
                                                </tr>
                                                <?php $i++;?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection

@section('pagescript')

@endsection
