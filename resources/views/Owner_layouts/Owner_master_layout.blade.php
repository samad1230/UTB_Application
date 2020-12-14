

    @include('Owner_layouts.header')
    <div class="app-admin-wrap layout-sidebar-large">
    @include('Owner_layouts.Owner_top_left_nav')


    @guest

    @else





    @endguest


        @yield('content')


    @include('Owner_layouts.footer')



