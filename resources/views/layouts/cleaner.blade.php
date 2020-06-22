<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <style>
    .notifications {
      /* background: black; */
      bottom: 57px;
      top: 57px;
      height: 608px;
      display: block;
      position: absolute;
      right: 0px;
      width: 20vw;
    }

    .list-group-item-success {
      background-color: #757e77 !important;
    }
  </style>
  @include('inc.cleaner.header_files')

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
          <a class="nav-link bell-btn" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-bell">
              <span class="notification-count"></span>
            </i>
          </a>
        </li>
      </ul>


    </nav>
    <!-- #################### Navbar ##################### -->

    <!-- ######################ASIDE###################### -->
    @include('inc.cleaner.aside')
    <!-- ######################ASIDE###################### -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <main class="">
        @yield('content')
      </main>

      <footer class="main-footer">
        <strong>Copyright &copy; 2020 <a href="#">HouseKeeper</a>.</strong>
        All rights reserved.

      </footer>

      <!-- Control Sidebar -->
      <div class="notification-center notifications control-sidebar-dark" style="display: none;">
        <div class="list-group">

        </div>
      </div>
      {{-- <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside> --}}
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

  </div>

  <!-- ##################FOOTERFILES################## -->
  @include('inc.cleaner.footer_files')
  <!-- ##################FOOTERFILES################## -->
  <script>
    $('.bell-btn').on('click',function (){      
      $('.notification-center').toggle();
    });
    
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: "get",
        url: "{{ url('/cleaner/fetchNotifications') }}",        
        success: function (response) {
          if(response.length >= 1){   
            $('.notification-count').html(response.length);
            // clear previus data 
            $('.notifications .list-group').html('');
          response.forEach((each , index) =>{            
            $('.notifications .list-group').append(`<a href="#" onclick="readAt(${each.id}, '${each.route}' )" class="list-group-item list-group-item-action list-group-item-success">${(each.type == 'invitation' ? 'You have recieved new invitation from ' : 'else condition' )}${each.by}</a>`);
          })
        }else{
          $('.notifications .list-group').html(`<a href="#"  class="list-group-item list-group-item-action list-group-item-success">No notification </a>`);
        }
        }
      });      
    });
    
    function readAt(id , route){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: "post",
        url: "{{ url('/cleaner/notificationReadAt') }}",
        data: {id: id , route: route },
        success: function (response) {
          window.location.href = route;
        }
      });
    }
  </script>
</body>

</html>