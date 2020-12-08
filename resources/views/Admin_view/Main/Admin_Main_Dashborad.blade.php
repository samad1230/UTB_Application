@extends('Admin_layouts.Admin_master_layout')
@section('content')

    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <!-- MAIN SIDEBAR CONTAINER start-->
            <div class="inbox-main-sidebar-container" data-sidebar-container="main">

                <div class="inbox-main-content" data-sidebar-content="main">
                    <div class="inbox-secondary-sidebar-container box-shadow-1" data-sidebar-container="secondary">
                        <div data-sidebar-content="secondary">
                            <div class="inbox-secondary-sidebar-content position-relative" style="min-height: 500px">
                                <div class="inbox-details perfect-scrollbar rtl-ps-none" data-suppress-scroll-x="true" style="padding: 1.5rem 5rem;">
                                    <button class="btn btn-rounded btn-primary btn-block mb-4">User Registration Form</button>
                                    <form action="{{route('User.registration')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        <div class="secendform">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label class="user_name" for="Name">User Name :</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" name="stafname" class="form-control" id="" placeholder="User Name" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label class="user_name" for="">Email Address :</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="email" name="email" class="form-control" id="" autocomplete="off" placeholder="Email Address">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label class="user_name" for="">Password :</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="password" name="password" class="form-control" id="" autocomplete="off" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label class="user_name" for="">Staff ID :</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" name="stafid" class="form-control" id="" autocomplete="off" placeholder="Staff ID">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label class="user_name" for="">User Type :</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="form-control" name="usertype" id="">
                                                        <option value="">Select User Type</option>
                                                        @foreach($roledata as $row)
                                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label class="user_name" for="">Department :</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="form-control js-example-basic-multiple" name="states[]" multiple="multiple" style="width: 240px">
                                                        @foreach($department as $data)
                                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                </div>
                                                <div class="col-md-6">
                                                    <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Submit</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Secondary Inbox sidebar start-->
                        <div class="inbox-secondary-sidebar perfect-scrollbar rtl-ps-none" data-sidebar="secondary"><i class="sidebar-close i-Close" data-sidebar-toggle="secondary"></i>
                            @foreach($userdata as $row)
                                @php
                                    $profice = \App\Admin_model\User_Profile::where('user_id',$row->id)->first();

                                   if ($profice != null){
                                       if($profice->user_image !=null){
                                           $url=URL::to('/Media/user_profile/'.$profice->user_image);
                                       }else{
                                           $url = URL::to('/Media/user_profile/avatar.png');
                                       }
                                   }else{
                                     $url = URL::to('/Media/user_profile/avatar.png');
                                   }
                                @endphp

                            <div class="mail-item">
                                <div class="avatar"><img src="{{$url}}" alt="" /></div>
                                <div class="col-xs-6 details"><span class="name text-muted">{{$row->name}}</span>
                                    <p class="m-0">{{"Staff"}}</p>
                                </div>
                                <div class="col-xs-3 date"><span class="text-muted">{{$row->created_at}}</span></div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Secondary Inbox sidebar end-->
                    </div>
                </div>
                <!-- MAIN INBOX SIDEBAR-- 1st part--start -->
                <div class="inbox-main-sidebar" data-sidebar="main" data-sidebar-position="left">
                    <div class="pt-3 pr-3 pb-3"><i class="sidebar-close i-Close" data-sidebar-toggle="main"></i>
                        <button class="btn btn-rounded btn-success btn-block mb-4">Panel List</button>
                        <div class="pl-3">
                            <ul class="inbox-main-nav">
                                <li><a class="active" href="#"><i class="icon-regular"></i> Inventory Panel</a></li>
                                <li><a href="#"><i class="icon-regular"></i> Ecommerce Panel</a></li>
                                <li><a href="#"><i class="icon-regular"></i> Accounts Panel</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- MAIN INBOX SIDEBAR-- 1st part--end -->
            </div>
            <!-- MAIN SIDEBAR CONTAINER-->
        </div>
    </div>

@endsection
    @section('pagescript')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
