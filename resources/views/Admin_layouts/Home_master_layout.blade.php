

    @include('Admin_layouts.header')



    @guest

    @else





    @endguest


        @yield('content')


    @include('Admin_layouts.footer')



