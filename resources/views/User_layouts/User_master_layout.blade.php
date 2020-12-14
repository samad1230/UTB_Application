

    @include('User_layouts.header')
    <div class="app-admin-wrap layout-sidebar-large">
    @include('User_layouts.User_top_left_nav')


    @guest

    @else



    @endguest


        @yield('content')


    @include('User_layouts.footer')



