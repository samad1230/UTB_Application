

    @include('Common_header_footer.header')
    <div class="app-admin-wrap layout-sidebar-large">

    @include('Department_layouts.navbar.Sales_top_left_nav')


    @guest

    @else





    @endguest


        @yield('content')


    @include('Common_header_footer.footer')



