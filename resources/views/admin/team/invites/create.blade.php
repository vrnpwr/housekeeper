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
        @livewire('invitation-form' , ['properties' => $properties])
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
    window.livewire.on('success', message => {
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: `${message}`,
        showConfirmButton: false,
        timer: 1500
      })
    })
    
    window.livewire.on('error', message => {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: `${message}`,
      })
    });
    // invoke select 2
    $('.properties').select2();
    // pass selected property Ids in livewire component
    $('.properties').on('change', function (e) {
      var data = $('.properties').select2("val");
      $('#prop_ids').val(data);
      window.livewire.emit('add_array',data)
    });
    
    // change details according to method
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
    
    
  });
</script>
@endpush


@endsection