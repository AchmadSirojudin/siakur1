<!DOCTYPE html>
<html lang="en">
@include('admin.header')

<body class="g-sidenav-show  bg-gray-200">
    @include('admin.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('admin.navbar')
        <div class="container-fluid py-4">
            @yield('content')
            @include('sweetalert::alert')
            @include('admin.footer')
        </div>
    </main>
    @include('admin.setting')
    @include('admin.js')
</body>

</html>
