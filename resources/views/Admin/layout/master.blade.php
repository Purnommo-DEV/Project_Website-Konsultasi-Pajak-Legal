<!DOCTYPE html>
<html lang="en">

@include('Admin.layout._head')

<body>
    @include('sweetalert::alert')
    <div id="app">

        @include('Admin.layout._sidebar')
        <div id="main">


            @include('Admin.layout._header')


            <div class="page-content">
                @yield('konten-admin')

            </div>
            @include('Admin.layout._footer')

        </div>
    </div>
    @include('Admin.layout._script')
    @yield('script')
    @stack('script')
</body>

</html>
