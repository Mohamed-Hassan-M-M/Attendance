<!DOCTYPE html>
<html lang="en">
    @include('admin.includes.head')
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Navbar -->
    @include('admin.includes.navbar')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.includes.sidebar')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include('admin.includes.footer')
</div>
<!-- ./wrapper -->

    @include('admin.includes.script')

</body>
</html>
