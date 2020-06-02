<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  @include('inc.header_files')
  @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div id="app" class="wrapper">

    <!-- #################### Navbar ##################### -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- #################### Navbar ##################### -->

    <!-- ######################ASIDE###################### -->
    @include('inc.aside')
    <!-- ######################ASIDE###################### -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <main class="">
        @include('sweetalert::alert')
        @yield('content')
      </main>

      <footer class="main-footer">
        <strong>Copyright &copy; 2020 <a href="#">HouseKeeper</a>.</strong>
        All rights reserved.

      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

  </div>

  <!-- ##################FOOTERFILES################## -->
  @include('inc.footer_files')
  <!-- ##################FOOTERFILES################## -->

  @livewireScripts
</body>

</html>