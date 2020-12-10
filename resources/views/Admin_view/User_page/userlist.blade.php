@extends('Admin_layouts.Admin_master_layout')
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
                                    <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="i-Add-User text-white mr-2"></i> Add Contact</button>
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
{{--                                                @php--}}


{{--                                                       $profile = DB::table('user__profiles')->where('user_id',$row->id)->first();--}}

{{--                                                           if ($profile != null){--}}
{{--                                                              if($profile->user_image !=null){--}}
{{--                                                                  $url=URL::to('/Media/user_profile/'.$profile->user_image);--}}
{{--                                                              }else{--}}
{{--                                                                  $url = URL::to('/Media/user_profile/avatar.png');--}}
{{--                                                              }--}}
{{--                                                           }else{--}}
{{--                                                            $url = URL::to('/Media/user_profile/avatar.png');--}}
{{--                                                           }--}}
{{--                                                @endphp--}}

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
                                                    @foreach($row->departments as $department)
                                                        @php
                                                            $count++;
                                                        @endphp
                                                        <span><i>{{ $department->name }}</i></span>
                                                        @if(count($row->departments) != $count)
                                                            <br>
                                                        @endif

                                                    @endforeach
                                                </td>
                                                <td><a class="ul-link-action text-success" href="" data-toggle="tooltip" data-placement="top" title="Edit"><i class="i-Edit"></i></a><a class="ul-link-action text-danger mr-1" href="" data-toggle="tooltip" data-placement="top" title="Want To Delete !!!"><i class="i-Eraser-2"></i></a></td>
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


@endsection
