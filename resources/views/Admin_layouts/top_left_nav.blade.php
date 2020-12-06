
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
                    <img src="{{asset('Admin_asset/dist-assets/images/faces/1.jpg')}}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-header">
                            <i class="i-Lock-User mr-1"></i> Timothy Carlson
                        </div>
                        <a class="dropdown-item">Account settings</a>
                        <a class="dropdown-item">Billing history</a>
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
    <div class="side-content-wrap">
        <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
            <ul class="navigation-left">
                <li class="nav-item" data-item=""><a class="nav-item-hold" href="{{URL::to('/')}}"><i class="nav-icon i-Bar-Chart"></i><span class="nav-text">Dashboard</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="uikits"><a class="nav-item-hold" href="#"><i class="nav-icon i-Library"></i><span class="nav-text">UI kits</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="extrakits"><a class="nav-item-hold" href="#"><i class="nav-icon i-Suitcase"></i><span class="nav-text">Extra kits</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="apps"><a class="nav-item-hold" href="#"><i class="nav-icon i-Computer-Secure"></i><span class="nav-text">Apps</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="widgets"><a class="nav-item-hold" href="#"><i class="nav-icon i-Computer-Secure"></i><span class="nav-text">Widgets</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="charts"><a class="nav-item-hold" href="#"><i class="nav-icon i-File-Clipboard-File--Text"></i><span class="nav-text">Charts</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="forms"><a class="nav-item-hold" href="#"><i class="nav-icon i-File-Clipboard-File--Text"></i><span class="nav-text">Forms</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item"><a class="nav-item-hold" href="#"><i class="nav-icon i-File-Horizontal-Text"></i><span class="nav-text">Datatables</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="sessions"><a class="nav-item-hold" href="#"><i class="nav-icon i-Administrator"></i><span class="nav-text">Sessions</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item active" data-item="others"><a class="nav-item-hold" href="#"><i class="nav-icon i-Double-Tap"></i><span class="nav-text">Others</span></a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item"><a class="nav-item-hold" href="#" target="_blank"><i class="nav-icon i-Safe-Box1"></i><span class="nav-text">Doc</span></a>
                    <div class="triangle"></div>
                </li>
            </ul>
        </div>
        <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
            <!-- Submenu Dashboards-->

            <ul class="childNav" data-parent="forms">
                <li class="nav-item"><a href="#"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">Basic Elements</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-Split-Vertical"></i><span class="item-name">Form Layouts</span></a></li>
            </ul>
            <ul class="childNav" data-parent="apps">
                <li class="nav-item"><a href="#"><i class="nav-icon i-Add-File"></i><span class="item-name">Invoice</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-Email"></i><span class="item-name">Inbox</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-Speach-Bubble-3"></i><span class="item-name">Chat</span></a></li>
            </ul>
            <ul class="childNav" data-parent="widgets">
                <li class="nav-item"><a href="#"><i class="nav-icon i-Receipt-4"></i><span class="item-name">widget card</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-Receipt-4"></i><span class="item-name">widget statistics</span></a></li>
            </ul>
            <!-- chartjs-->
            <ul class="childNav" data-parent="charts">
                <li class="nav-item"><a href="#"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">echarts</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">ChartJs</span></a></li>
                <li class="nav-item dropdown-sidemenu"><a href=""><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">Apex Charts</span><i class="dd-arrow i-Arrow-Down"></i></a>
                    <ul class="submenu">
                        <li><a href="#">Area Charts</a></li>
                        <li><a href="#">Bar Charts</a></li>
                        <li><a href="#">Bubble Charts</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="childNav" data-parent="extrakits">
                <li class="nav-item"><a href="#"><i class="nav-icon i-Crop-2"></i><span class="item-name">Image Cropper</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-Loading-3"></i><span class="item-name">Loaders</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-Loading-2"></i><span class="item-name">Ladda Buttons</span></a></li>
            </ul>
            <ul class="childNav" data-parent="uikits">
                <li class="nav-item"><a href="#"><i class="nav-icon i-Bell1"></i><span class="item-name">Alerts</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-Split-Horizontal-2-Window"></i><span class="item-name">Accordion</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-Medal-2"></i><span class="item-name">Badges</span></a></li>
            </ul>
            <ul class="childNav" data-parent="sessions">
                <li class="nav-item"><a href="#"><i class="nav-icon i-Checked-User"></i><span class="item-name">Sign in</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-Add-User"></i><span class="item-name">Sign up</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-Find-User"></i><span class="item-name">Forgot</span></a></li>
            </ul>
            <ul class="childNav" data-parent="others">
                <li class="nav-item"><a href="#"><i class="nav-icon i-Error-404-Window"></i><span class="item-name">Not Found</span></a></li>
                <li class="nav-item"><a href="#"><i class="nav-icon i-Male"></i><span class="item-name">User Profile</span></a></li>
                <li class="nav-item"><a class="open" href="#"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Blank Page</span></a></li>
            </ul>
        </div>
        <div class="sidebar-overlay"></div>
    </div>

