@extends('Owner_layouts.Owner_master_layout')
@section('content')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
        @include('Admin_layouts.pagetitlewoner')
            <!-- MAIN SIDEBAR CONTAINER start-->
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
                                                            <th scope="col">Name</th>
                                                            <th scope="col">User Type</th>

                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $sl = 1; ?>
                                                        @foreach ($userdata as $row)
                                                        <tr>
                                                            <th scope="row">{{$sl}}</th>
                                                            <td>{{$row->name}}</td>
                                                            <td>{{ $row->role->name }}</td>
                                                            <td><span class="badge badge-success"><?php $statusnew = $row->status; if ($statusnew==1) {echo "Active";}else{echo "Inactive";} ?></span></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-success" type="button"><i class="nav-icon i-Pen-2"></i></button>
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
                        <!-- Secondary Inbox sidebar start-->
                        <div class="inbox-secondary-sidebar perfect-scrollbar rtl-ps-none" data-sidebar="secondary"><i class="sidebar-close i-Close" data-sidebar-toggle="secondary"></i>
                            @foreach($allservice as $data)
                            <div class="mail-item">

                                    <div class="col-md-8">
                                        <h5 style="font-weight: bold">{{$data->name}} Department</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary" type="button">Access</button>
                                    </div>

                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>


            </div>

        </div>
    </div>



    <div class="modal fade" id="servicepaneladd" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Service Panel</h4>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('service.registration')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Service name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="service" class="form-control" placeholder="Service Name" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Address">Service Title</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="servicetitle" placeholder="Service Title" >
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
