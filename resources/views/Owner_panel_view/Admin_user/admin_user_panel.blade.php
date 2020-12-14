@extends('Owner_layouts.Owner_master_layout')
@section('content')

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Admin_layouts.pagetitle')
                <div class="separator-breadcrumb border-top"></div>
                <section class="contact-list">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card text-left">
                                <div class="card-header text-right bg-transparent">
                                    <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#addadmin"><i class="i-Add-User text-white mr-2"></i> Add Contact</button>

                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display table" id="ul-contact-list" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>User Type</th>
                                                <th>Joining Date</th>
                                                <th>Department</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($userdatalist as $row)

                                                <tr>
                                                    <td><a href="">
                                                            <div class="ul-widget-app__profile-pic"><img class="profile-picture avatar-sm mb-2 rounded-circle img-fluid" src="{{ asset($row->profile != null? 'Media/user_profile/'. $row->profile->user_image:'') }}" alt="" />
                                                                <span class="text-capitalize font-weight-bold">{{ $row->name }}</span>
                                                            </div>
                                                        </a></td>
                                                    <td>{{ $row->email }}</td>
                                                    <td>{{ $row->profile != null?$row->profile->phone:'' }}</td>
                                                    <td><a class="badge badge-primary m-2 p-2" href="#">{{ $row->role->name }}</a></td>
                                                    <td>{{ date('d-M-Y',strtotime($row->created_at)) }}</td>
                                                    <td>
                                                        @php
                                                            $count = 0;
                                                        @endphp
                                                        @if($row->role_id == 2)
                                                            <span><i>Admin Department</i></span>
                                                        @else
                                                        @foreach($row->departments as $department)

                                                                @php
                                                                    $count++;
                                                                @endphp
                                                                <span><i>{{ $department->name }}</i></span>
                                                                @if(count($row->departments) != $count)
                                                                    <br>
                                                                @endif

                                                        @endforeach
                                                        @endif
                                                    </td>
                                                    <td><a class="ul-link-action text-success" href="" data-toggle="tooltip" data-placement="top" title="Edit"><i class="i-Edit"></i></a></td>
                                                </tr>
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



    <div class="modal fade" id="addadmin" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                    <form action="{{route('admin.registration')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">User name :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="user_name" class="form-control" id="" placeholder="User Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Email Address :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" name="email" class="form-control" id="" autocomplete="off" placeholder="Email Address">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Password :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="password" name="password" class="form-control" id="" autocomplete="off" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Staff ID :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="stafid" class="form-control" id="" autocomplete="off" placeholder="Staff ID">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">User Type :</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="usertype" id="">
                                        <option value="">Select User Type</option>
                                        @foreach($roledata as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
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
