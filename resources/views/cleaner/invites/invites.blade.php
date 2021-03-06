@extends('layouts.cleaner')

@section('content')


@push('styles')
<link href="{{ asset('plugins/lightbox_2/dist/css/lightbox.css') }}" rel="stylesheet" />
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

  .box {
    border: 1px solid gray;
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
          <li class="breadcrumb-item active">Invitations</li>
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
            <p><small class="d-inline mr-5 font-weight-bold">( Step one pending )</small></p>
            <a href="{{ url('cleaner/information') }}" class="small-box-footer btn btn-danger">Step 1</a>
          </div>
          @elseif(!$formTwo)
          <!-- small box -->
          <div class="d-flex">
            <h3 class="d-inline mr-5">Update address </h3>
            <p><small class="d-inline mr-5 font-weight-bold">( Step two pending )</small></p>
            <a href="{{ url('cleaner/address') }}" class="btn btn-danger d-inline">Step 2</a>
          </div>
          @elseif(!$formThree)
          <div class="d-flex">
            <h3 class="d-inline mr-5">Upload Profile Photo </h3>
            <p><small class="d-inline mr-5 font-weight-bold">( Step four pending )</small></p>
            <a href="{{ url('cleaner/profile_photo') }}" class="btn btn-danger d-inline">Step 4</a>
          </div>
          @elseif(!$formFour)
          <div class="d-flex">
            <h3 class="d-inline mr-5">Complete Identity Information </h3>
            <p><small class="d-inline mr-5 font-weight-bold">( Step four pending )</small></p>
            <a href="{{ url('cleaner/identity') }}" class="btn btn-danger d-inline">Step 4</a>
          </div>
          @else
          @if (!is_null($invitations_details))

          @foreach ($invitations_details["property_details"] as $key=>$item)
          {{-- {{ dd($item->property_name) }} --}}
          {{-- <li class="list-group-item">{{ $item }}</li> --}}
          <div class="row p-1 mb-1 box">
            <div class="col-3">
              <p class="font-weight-bold d-inline-block">
                {{ $item->property_name }}
              </p>
              {{-- Property Details --}}
              <p class="d-inline-block">
                {{ $item->city }} ,
                {{ $item->state }} ,
                {{ $item->country }}
              </p>
              {{-- From --}}
              <p class="float-float d-block">
                <small class="text-lead">{{ $invitations_details['invitations_from'][0]->email }}</small>
              </p>
              <p class="float-float d-block">
                <small class="text-lead">{{ $invitations_details['invitations_from'][0]->name }}</small>
              </p>
            </div> {{-- Images --}}
            <div class="col-6">
              @php
              $image = $item->property_image ?
              $item->property_image : 'placeholder/home-placeholder.jpg'
              @endphp
              <div class="mt-3">
                <a href="{{ url('/images/'.$image) }}" data-lightbox="property_image" data-title="My caption">
                  <img src="{{ url('/images/'.$image) }}" width="80px" alt="property_image">
                </a>
                @if(!is_null($item->property_image2))
                <a href="{{ url('/images/'.$item->property_image2) }}" data-lightbox="property_image"
                  data-title="My caption">
                  <img src="{{ url('/images/'.$item->property_image2) }}" width="80px" alt="property_image">
                </a>
                @endif

                @if(!is_null($item->property_image3))
                <a href="{{ url('/images/'.$item->property_image3) }}" data-lightbox="property_image"
                  data-title="My caption">
                  <img src="{{ url('/images/'.$item->property_image3) }}" width="80px" alt="property_image">
                </a>
                @endif

                @if(!is_null($item->property_image4))
                <a href="{{ url('/images/'.$item->property_image4) }}" data-lightbox="property_image"
                  data-title="My caption">
                  <img src="{{ url('/images/'.$item->property_image4) }}" width="80px" alt="property_image4">
                </a>
                @endif

                @if(!is_null($item->property_image5))
                <a href=" {{ url('/images/'.$item->property_image5) }}" data-lightbox="property_image"
                  data-title="My caption">
                  <img src="{{ url('/images/'.$item->property_image5) }}" width="80px" alt="property_image5">
                </a>
                @endif
              </div>
            </div>

            <div class=" col-3 pt-3">
              <div class="text-center d-inline-block">
                <button class="btn btn-success cleaner_action" data-value="1"
                  data-id={{ $invitations_details['invitation_id'][0] }}>Accept</button>
                <button class="btn btn-danger cleaner_action" data-id={{ $invitations_details['invitation_id'][0] }}
                  data-value="0">reject</button>
                <button class="btn btn-warning">Quote</button>
              </div>
            </div>

          </div>
          @endforeach
          @else
          <p>No Invitation found</p>
          @endif
          {{-- <p>Your Profile Completed</p> --}}
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
<script src="{{ asset('plugins/lightbox_2/dist/js/lightbox.js') }}"></script>
<script>
  $(document).ready(function () {
  lightbox.option({
      'resizeDuration': 1000,
      'wrapAround': true
  })  
});

$('.cleaner_action').on('click' , function() {
  var value = $(this).attr('data-value');
  var id = $(this).attr('data-id');
  var data ={};
  data.status = value;
  data.id = id;
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  if(value == 1){
    Swal.fire({
  title: 'Are you sure?',
  text: "Are you sure to connect with Host!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
  if (result.value) {
  //  Change Status zero
  $.ajax({
    type: "post",
    url: "{{ url('cleaner/invite/change') }}",
    data: data,    
    success: function (response) {
      console.log("success");
      window.location.reload();
    },
    
  });
  }
})    
  }else if(value == 0){
    Swal.fire({
  title: 'Are you sure?',
  text: "Are you sure to reject Host invitation!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
  if (result.value) {
    $.ajax({
    type: "post",
    url: "{{ url('cleaner/invite/change') }}",
    data: data,    
    success: function (response) {
      console.log("success");
      window.location.reload();
    },
    
  });
  }
})
  }
})

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