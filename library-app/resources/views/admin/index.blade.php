@include('partials.header')

<div class="wrapper">

    <!-- Preloader -->
    @include('admin.preloader')

    <!-- Navbar -->
    @include('admin.topnav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
    @include('admin.content')
    <!-- /.content-wrapper -->

    <!-- main footer -->
    @include('admin/main_footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('partials.footer')