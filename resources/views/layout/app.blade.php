
<!DOCTYPE html>
<html lang="en">
@include('layout/header')

<body id="page-top">
    @include('sweetalert::alert')
    <!-- Page Wrapper -->
    <div id="wrapper">

@include('layout.sitebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                @include('layout.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')
            </div>
            <!-- End of Main Content -->

            @include('layout.footer')
@include('layout.js')

</body>

</html>
