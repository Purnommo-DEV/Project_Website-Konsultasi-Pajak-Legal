<!DOCTYPE html>
<html lang="en">

@include('Front.layout._head')

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    @if (!request()->routeIs('HalamanRegister') && !request()->routeIs('HalamanLogin'))
        @include('Front.layout._navbar')
    @endif
    <!-- Navbar End -->

    @yield('konten')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    @include('Front.layout._script')
    @yield('script')
</body>

</html>
