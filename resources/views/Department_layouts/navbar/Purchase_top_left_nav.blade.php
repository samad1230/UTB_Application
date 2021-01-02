
    <div class="main-header">
        <div class="logo">
            <img src="{{asset('Admin_asset/dist-assets/images/logo.png')}}" alt="">
        </div>
        <div class="menu-toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>



        <div style="margin: auto"></div>
        <div class="header-part-right">
            <div class="dropdown">
                <div class="user col align-self-end">
                    @php
                        $userdata = Auth::user();

                        $profice = $userdata->profile;

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
                    <img src="{{$url}}" id="userDropdown" alt="Image" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-header">
                            <i class="i-Lock-User mr-1"></i> {{Auth::user()->name}}
                        </div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#updateprofile">Profile Update</a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"><span class="edu-icon edu-locked author-log-ic"></span>
                            {{ __('Sign out') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $user =  Auth::user()->role->id;
          if ($user==1){
              $url= '/owner/dashboard';
          }else if ($user==2){
               $url= '/Admin/Dashboard';
          }else if ($user==3){
               $url= 'User/Dashboard';
          }else{
              return false;
          }
    @endphp

    <div class="side-content-wrap">
        <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
            <ul class="navigation-left">
                <li class="nav-item" data-item=""><a class="nav-item-hold" href="{{URL::to($url)}}"><i class="nav-icon i-Bar-Chart"></i><span class="nav-text">Dashboard</span></a>
                    <div class="triangle"></div>
                </li>

                <li class="nav-item" data-item="productmenu"><a class="nav-item-hold" href="#"><i class="nav-icon i-Suitcase"></i><span class="nav-text">Product </span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="apps"><a class="nav-item-hold" href="#"><i class="nav-icon i-Computer-Secure"></i><span class="nav-text">Apps</span></a>
                    <div class="triangle"></div>
                </li>
            </ul>
        </div>
        <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">

            <ul class="childNav" data-parent="productmenu">
                <li class="nav-item"><a href="{{route('add.categories')}}"><i class="nav-icon i-Add"></i><span class="item-name">Add Categories</span></a></li>
                <li class="nav-item"><a href="{{route('add.subcategory')}}"><i class="nav-icon i-Add"></i><span class="item-name">Sub Category</span></a></li>
                <li class="nav-item"><a href="{{route('add.procategory')}}"><i class="nav-icon i-Add"></i><span class="item-name">Pro Category</span></a></li>
                <li class="nav-item"><a href="{{route('add.brand')}}"><i class="nav-icon i-Add"></i><span class="item-name">Brand</span></a></li>
                <li class="nav-item"><a href="{{route('Product.index')}}"><i class="nav-icon i-Add"></i><span class="item-name">Product</span></a></li>
                <li class="nav-item"><a href="{{route('Product.details')}}"><i class="nav-icon i-Add"></i><span class="item-name"> Product Details</span></a></li>
            </ul>

            <ul class="childNav" data-parent="apps">
                <li class="nav-item"><a href="#"><i class="nav-icon i-Add-File"></i><span class="item-name">Invoice</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-Email"></i><span class="item-name">Inbox</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-Speach-Bubble-3"></i><span class="item-name">Chat</span></a></li>
            </ul>

        </div>

        <div class="sidebar-overlay"></div>

    </div>




    <div class="modal fade" id="updateprofile" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Update Profile</h4>
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
                    <form action="{{route('Admin_profile.update')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <input type="hidden" name="userid" value="{{$userdata->id}}">
                        <input type="hidden" name="nameold" value="{{$userdata->name}}">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Showroom Name">Full Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="user_name" class="form-control" placeholder="Full Name" value="{{$userdata->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Address</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="address" class="form-control" id="address_add" value="{{@$profice->address}}" placeholder="Address">
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Contact</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="mobile" class="form-control" value="{{@$profice->phone}}" placeholder="Contact">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">National ID</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="nationalid" class="form-control"  placeholder="National ID NO" value="{{@$profice->national_id}}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Profile Image</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="profileimage" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">National ID Image</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="nidimage" class="form-control">
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
