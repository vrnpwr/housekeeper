@extends('layouts.cleaner')

@section('content')


@push('styles')

<style type="text/css">
  .add-property {
    float: right;
  }

  .mdtp__wrapper {
    bottom: 120px !important;
  }

  .heading {
    font-size: 1.2em;
    margin-bottom: 25px;
  }

  .option {
    margin: 35px 7px;
    font-size: 18px;
  }

  .custom-control.custom-checkbox {
    margin: 35px 7px;
    font-size: 18px;
  }
</style>


@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        {{-- <h1 class="m-0 text-dark">
          <h3><i class="fas fa-cog mr-3"></i>Notification Setting</h3>
        </h1> --}}
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">My Jobs</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-12">
        <div class="card card-primary p-5">
          @if(!$formOne)
          <!-- small box -->
          <div class="d-flex">
            <h3 class="d-inline mr-5">Complete Your Profile first</h3>
            <a href="{{ url('cleaner/information') }}" class="small-box-footer btn btn-danger">Fill Form !</a>
          </div>
          @elseif(!$formTwo)
          <!-- small box -->
          <div class="d-flex">
            <h3 class="d-inline mr-5">Complete Your Profile first</h3>
            <a href="{{ url('cleaner/identity') }}" class="btn btn-danger d-inline">Fill Form
              2</a>
          </div>
          @else
          <p>Your Profile Completed</p>
          @endif

        </div>
      </div>
    </div>
  </div>

  </div>
  <!-- /.container-fluid -->
</section>
<!-- /. content -->
</div>
<!-- /. content-wrapper -->


@push('script')
<script>
  // add multiple select / deselect functionality For Notification
  $("#selectall_notification").click(function () {
    $('.case_notification').attr('checked', this.checked);
  });
  
  $(".case_notification").click(function(){
    
    if($(".case_notification").length == $(".case_notification:checked").length) {
      $("#selectall_notification").attr("checked", "checked");
    } else {
      $("#selectall_notification").removeAttr("checked");
    }
  });
  // add multiple select / deselect functionality For Email
  
  $("#selectall_email").click(function () {
    $('.case_email').attr('checked', this.checked);
  });
  
  $(".case_email").click(function(){
    
    if($(".case_email").length == $(".case_email:checked").length) {
      $("#selectall_email").attr("checked", "checked");
    } else {
      $("#selectall_email").removeAttr("checked");
    }
  });
  
  // add multiple select / deselect functionality For Mobile
  
  $("#selectall_mobile").click(function () {
    $('.case_mobile').attr('checked', this.checked);
  });
  
  $(".case_mobile").click(function(){
    
    if($(".case_mobile").length == $(".case_mobile:checked").length) {
      $("#selectall_mobile").attr("checked", "checked");
    } else {
      $("#selectall_mobile").removeAttr("checked");
    }
  });
  
  // add multiple select / deselect functionality For SMS
  
  
  $("#selectall_sms").click(function () {
    $('.case_sms').attr('checked', this.checked);
  });
  
  $(".case_sms").click(function(){
    
    if($(".case_sms").length == $(".case_sms:checked").length) {
      $("#selectall_sms").attr("checked", "checked");
    } else {
      $("#selectall_sms").removeAttr("checked");
    }
  });
  
  /* SUBMIT/UPDATE NOTIFICATION FORM WITH AJAX */
  
  $("#notification-btn").on('click', function(event) {
    event.preventDefault();
    var notification = $("input[name='notification\\[\\]']:checked").map(function(){return $(this).val();}).get();
    var email = $("input[name='email\\[\\]']:checked").map(function(){
      return $(this).val();
    }).get();
    var mobile = $("input[name='mobile\\[\\]']:checked").map(function(){return $(this).val();}).get();
    var sms = $("input[name='sms\\[\\]']:checked").map(function(){return $(this).val();}).get();
    // console.log(notification);
    // var data = $("#form").serialize();
    updateNotification();
    /* Act on the event */
  });
  
  /*Update Notification Function*/
  function updateNotification(){
    
    $.ajax({
      type: 'POST',
      url: '{{ url('cleaner/notification') }}',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: $('form').serialize(),
      success:function(data){		
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Your work has been saved',
          showConfirmButton: false,
          timer: 1500
        })
        .then(() => {
          // window.location.reload();
          // $('#form').trigger("reset");
          // $(".print-error-msg").css('display','none');
        })				
        
      },
      
      error: function (jqXHR, textStatus, errorThrown) 
      {  
        swal({
          title: "Something error",
          text: "Check input fields!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      }
      
    })
    
  }
  
  /* SUBMIT/UPDATE NOTIFICATION FORM WITH AJAX */
  
</script>
@endpush


@endsection