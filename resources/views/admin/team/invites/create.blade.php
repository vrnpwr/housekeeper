@extends('layouts.admin')

@section('content')


@push('styles')

<style type="text/css">

</style>


@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 mt-5">
        <h1 class="m-0 text-dark"><i class="fas fa-home mr-3"></i>Pending Invitations</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Invites </li>
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
        <div class="card">
          {{-- <div class="card-header">
            <div class="add-property">
              <a href="{{ url('/cleaner/create') }}" class="btn btn-primary float-right">Invite cleaner</a>
        </div>
      </div> --}}
      <!-- /.card-header -->
      <div class="card-body">
        <div class="">
          <form id="invite-form" type="post">
            <div class="row">
              <div class="col-12">

                <div class="select2-purple">
                  <label for="properties_id">Select the properties you want to share with this cleaner.</label>
                  <select id="property_ids" class="select2 @error('property_ids') is-invalid @enderror"
                    name="property[]" multiple="multiple" data-placeholder="Select Cleaners"
                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                    @foreach($properties as $key=>$property)
                    <option value="{{ $property->id }}">{{ $property->property_name }}</option>
                    @endforeach
                  </select>
                  @error('property_ids')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              {{-- / col-12 --}}
              @php
              $dynamicName = "Phone Number";
              @endphp
              <div class="col-4">
                <div class="form-group">
                  <label for="invitation_type">Method</label>
                  <select id="invitation_type" class="custom-select" name="invitation-type">
                    <option selected disabled>Select type</option>
                    <option value="email">Email</option>
                    <option value="phone">Phone</option>
                  </select>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="name" id="cleaner_name" class="form-control"
                    placeholder="Enter Cleaner Name">
                </div>
              </div>

              <div class="col-4">
                <div class="form-group">
                  <div id="dynamic-container">
                    <label for="">Email</label>
                    <input type="email" name="email" id="type" class="form-control" placeholder="Enter Email">
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label for="my-input">Invitation Message</label>
                  <input id="invitation_message" class="form-control" type="text" name="Invitation-message">
                </div>
              </div>
              {{-- Submit Button --}}
              <div class="form-group">
                <button type="submit" class="btn btn-primary ml-1">Submit</button>
              </div>
            </div>
          </form>
        </div>

      </div>
      <!-- /.card-body -->
    </div>
  </div>
  </div>
  <!-- /.row -->
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <!-- right col -->
  </div>
  <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@push('script')
<script>
  $(document).ready(function($) {
    $('.select2').select2();
    // Select type Logic
    $("#invitation-type").on('change' , function() {
        $('#dynamic-container').html("");
      var val = $(this).val();
      if(val == 'email')
      {
        $('#dynamic-container').append(`<label for="">Email</label> <input type="email" name="type" id="details" class="form-control" placeholder="Enter type">`);
      }
      else{
        $('#dynamic-container').append(`<label for="">Phone</label> <input type="number" name="type" id="details" class="form-control" placeholder="Enter Phone Number">`);
      }
    });

    $('#invite-form').submit( function(e){
      e.preventDefault();
      var formData = {
            property_ids: $('#property_ids').val(),
            invitation_type: $('#invitation_type').val(),
            cleaner_name: $('#cleaner_name').val(),
            details: $('#details').val(),
            invitation_message : $('#invitation_message').val()
        };

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      $.ajax({
				type: 'POST',
				url: '{{ action('InviteController@store') }}',
        dataType: 'json',
				data: formData ,
				success:function(data){					
					if($.isEmptyObject(data.error)){
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
						
					}else{
						console.log(data.error);
						printErrorMsg(data.error);
					}
					
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
    })





  });
</script>
@endpush


@endsection