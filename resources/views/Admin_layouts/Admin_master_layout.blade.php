

    @include('Admin_layouts.header')
    <div class="app-admin-wrap layout-sidebar-large">
    @include('Admin_layouts.Admin_top_left_nav')


    @guest

    @else





    @endguest


        @yield('content')


    @include('Admin_layouts.footer')



