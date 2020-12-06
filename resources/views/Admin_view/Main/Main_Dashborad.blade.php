@extends('Admin_layouts.admin_master_layout')
@section('content')

    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <!-- MAIN SIDEBAR CONTAINER start-->
            <div class="inbox-main-sidebar-container" data-sidebar-container="main">


                <div class="inbox-main-content" data-sidebar-content="main">
                    <div class="inbox-secondary-sidebar-container box-shadow-1" data-sidebar-container="secondary">
                        <div data-sidebar-content="secondary">
                            <div class="inbox-secondary-sidebar-content position-relative" style="min-height: 500px">
                                <!-- EMAIL DETAILS-->
                                <div class="inbox-details perfect-scrollbar rtl-ps-none" data-suppress-scroll-x="true">
                                    <h4 class="mb-3">Main Content</h4>

                                </div>
                            </div>
                        </div>
                        <!-- Secondary Inbox sidebar start-->
                        <div class="inbox-secondary-sidebar perfect-scrollbar rtl-ps-none" data-sidebar="secondary"><i class="sidebar-close i-Close" data-sidebar-toggle="secondary"></i>
                            <div class="mail-item">
                                <div class="avatar"><img src="{{asset('Admin_asset/dist-assets/images/faces/1.jpg')}}" alt="" /></div>
                                <div class="col-xs-6 details"><span class="name text-muted">John Doe</span>
                                    <p class="m-0">Confirm your email</p>
                                </div>
                                <div class="col-xs-3 date"><span class="text-muted">20 Dec 2018</span></div>
                            </div>
                            <div class="mail-item">
                                <div class="avatar"><img src="{{asset('Admin_asset/dist-assets/images/faces/5.jpg')}}" alt="" /></div>
                                <div class="col-xs-6 details"><span class="name text-muted">John Doe</span>
                                    <p class="m-0">Confirm your email</p>
                                </div>
                                <div class="col-xs-3 date"><span class="text-muted">20 Dec 2018</span></div>
                            </div>
                        </div>
                        <!-- Secondary Inbox sidebar end-->
                    </div>
                </div>
                <!-- MAIN INBOX SIDEBAR-- 1st part--start -->
                <div class="inbox-main-sidebar" data-sidebar="main" data-sidebar-position="left">
                    <div class="pt-3 pr-3 pb-3"><i class="sidebar-close i-Close" data-sidebar-toggle="main"></i>
                        <button class="btn btn-rounded btn-primary btn-block mb-4">Compose</button>
                        <div class="pl-3">
                            <p class="text-muted mb-2">Browse</p>
                            <ul class="inbox-main-nav">
                                <li><a class="active" href=""><i class="icon-regular i-Mail-2"></i> Inbox (2)</a></li>
                                <li><a href=""><i class="icon-regular i-Mail-Outbox"></i> Sent</a></li>
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
