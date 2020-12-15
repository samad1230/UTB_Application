@extends('User_layouts.User_master_layout')
@section('content')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
        @include('Common_header_footer.pagetitlewoner')

            <div class="inbox-main-sidebar-container" data-sidebar-container="main">


                <div class="inbox-main-content" data-sidebar-content="main">
                    <div class="inbox-secondary-sidebar-container box-shadow-1" data-sidebar-container="secondary">

                        <div data-sidebar-content="secondary">
                            <div class="inbox-secondary-sidebar-content position-relative" style="min-height: 500px">
                                <!-- EMAIL DETAILS-->
                                <div class="inbox-details perfect-scrollbar rtl-ps-none" data-suppress-scroll-x="true">
                                    <div class="card text-left">
                                        <div class="card-body">
                                            <h4 class="card-title mb-3"> Access User </h4>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-dark">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">SL</th>
                                                        <th scope="col">Department</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $sl = 1; ?>
                                                    @foreach ($allservice as $data)
                                                        <?php //print_r($data); ?>
                                                        <tr>
                                                            <th scope="row">{{$sl}}</th>
                                                            <td>{{$data->name}} Department</td>
                                                            <td>

                                                                @if($data->department_id == 1)
                                                                    <a href="{{ route('purchase.department-access') }}" class="btn btn-sm btn-primary">Access</a>
                                                                @elseif($data->department_id == 2)
                                                                    <a href="{{ route('hradmin.department-access') }}" class="btn btn-sm btn-primary">Access</a>
                                                                @elseif($data->department_id == 3)
                                                                    <a href="{{ route('accounts.department-access') }}" class="btn btn-sm btn-primary">Access</a>
                                                                @elseif($data->department_id == 4)
                                                                    <a href="{{ route('commercial.department-access') }}" class="btn btn-sm btn-primary">Access</a>
                                                                @elseif($data->department_id == 5)
                                                                    <a href="{{ route('store.department-access') }}" class="btn btn-sm btn-primary">Access</a>
                                                                @elseif($data->department_id == 6)
                                                                    <a href="{{ route('sales.department-access') }}" class="btn btn-sm btn-primary">Access</a>
                                                                @endif
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
    </div>


@endsection
