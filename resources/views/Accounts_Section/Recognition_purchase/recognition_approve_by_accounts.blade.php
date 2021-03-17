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
                                <table class="table table-hover" id="ul-contact-list">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th>Recognition</th>
                                        <th>Date</th>
                                        <th>Total Item</th>
                                        <th>Approved</th>
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
                                        @php
                                            $username = \App\User::where('id',$row->approved_by)->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $sl}}</td>
                                            <td>{{ $row->recognition_no}}</td>
                                            <td>{{ $row->date}}</td>
                                            <td>{{ count($item)}}</td>
                                            <td>{{ @$username->name}}</td>
                                            <?php
                                            if ($row->status==1){
                                            ?>
                                            <td><a  class="btn btn-warning btn-sm"> Pending</a></td>
                                            <?php
                                            }else{
                                            ?>
                                            <td><a  class="btn btn-success btn-sm"> Done</a></td>
                                            <?php
                                            }
                                            ?>
                                            <td><a href="{{route('purchase.approve_details',$row->id)}}" class="btn-primary btn-sm"> View</a></td>

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
    <script>

    </script>
@endsection

