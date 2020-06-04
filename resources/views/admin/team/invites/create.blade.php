@extends('layouts.admin')

@section('content')


@push('styles')

<style type="text">

</style>


@endpush
<style>
  .has-error {
    border: 1.5px solid tomato !important;
  }
</style>


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 mt-5">
        <h1 class="m-0 text-dark">
          <i class="fas fa-home mr-3"></i>
          Pending Invitations
        </h1>
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
        {{-- @livewire('invitation-form' , ['properties' => $properties]) --}}
        {{-- Form --}}
        <div class="">
          <form method="post" action="/invite">
            {{ csrf_field() }}
            <div class="row">
              {{-- Formlive wire testing --}}
              <div class="col-12">
                <div class="select2-purple">
                  <label>Select the properties you want to share with this cleaner.</label>
                  <select class="properties{{ $errors->has('property_ids') ? ' has-error' : ''}}" name="property_ids[]"
                    multiple="multiple" placeholder="Select Cleaners" style="width: 100%;">
                    @foreach($properties as $key=>$property)
                    <option value="{{ $property->id }}">{{ $property->property_name }}</option>
                    @endforeach
                  </select>
                  @error('property_ids')
                  <span class="text-sm text-danger error">{{ $message }}</span>
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
                  <select class="custom-select{{ $errors->has('invitation_type') ? ' has-error' : ''}}"
                    name="invitation_type">
                    <option selected value="">Select type</option>
                    <option value="email">Email</option>
                    <option value="phone">Phone</option>
                  </select>
                  @error('invitation_type')
                  <span class="text-sm text-danger error">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="cleaner_name" placeholder="Enter Cleaner Name"
                    class="form-control{{ $errors->has('cleaner_name') ? ' has-error' : ''}}">
                  @error('cleaner_name')
                  <span class="text-sm text-danger error">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <div class="col-4">
                <div class="form-group">
                  <div id="dynamic-container">
                    <label for="">Email</label>
                    <input type="email" name="details" placeholder="Enter Email"
                      class="form-control{{ $errors->has('details') ? ' has-error' : ''}}">
                    @error('details')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label for="my-input">Invitation Message</label>
                  <input class="form-control{{ $errors->has('invitation_message') ? ' has-error' : ''}}" type="text"
                    name="invitation_message">
                  @error('invitation_message')
                  <span class="text-sm text-danger error">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              {{-- Submit Button --}}
              <div class="form-group">
                <button type="submit" class="btn btn-primary ml-1">Submit</button>
              </div>
            </div>
          </form>
        </div>

        {{-- / form --}}

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
    // call sweet alert from livewire component
    // window.livewire.on('success', message => {
    //   Swal.fire({
    //     position: 'top-end',
    //     icon: 'success',
    //     title: `${message}`,
    //     showConfirmButton: false,
    //     timer: 1500
    //   })
    // })
    
    // window.livewire.on('error', message => {
    //   Swal.fire({
    //     icon: 'error',
    //     title: 'Oops...',
    //     text: `${message}`,
    //   })
    // });

    // It will refresh screen after form submit
    // window.livewire.on('reload' , function(){
    //   setTimeout(function(){
    //                 window.location.reload();
    //   },1500);
    // });

    // Add has-error class to Select 2 with javascript
     

    // invoke select 2
    $('.properties').select2();
    // pass selected property Ids in livewire component
    $('.properties').on('change', function (e) {
      var data = $('.properties').select2("val");
      $('#prop_ids').val(data);
      window.livewire.emit('add_array',data)
    });
    
    // change details according to method
    $("#invitation_type").on('change' , function() {
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
    
    
  });
</script>
@endpush


@endsection