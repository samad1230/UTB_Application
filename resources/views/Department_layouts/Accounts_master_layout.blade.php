

    @include('Department_layouts.header')
    <div class="app-admin-wrap layout-sidebar-large">

    @include('Department_layouts.Accounts_top_left_nav')


    @guest

    @else





    @endguest


        @yield('content')


    @include('Department_layouts.footer')



