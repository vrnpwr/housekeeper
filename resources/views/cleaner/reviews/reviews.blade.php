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

  .form-heading {
    font-size: 1.5em;
    margin-bottom: 25px;
  }

  .profile-img {
    height: 200px;
    margin-top: 25px;
    margin-left: 35px;
  }

  .show-password-block {
    margin-top: 35px;
  }
</style>

@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
          <h3>Reviews</h3>
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Reviews </li>
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
    {{-- <i class="fas fa-star"></i> --}}
    <div class="jumbotron">
      <h1 class="display-6">My Reviews!</h1>
      <div class="text-center mt-5 mb-2">
        <h4 class="text-center">0</h4>
        @for($i = 0; $i < 5; $i++) <i class="far fa-star text-center" style="font-size: 2em;"></i>
          @endfor
      </div>
      <p class="lead text-center">You haven't been reviewed yet.</p>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /. content -->
</div>
<!-- /. content-wrapper -->

@push('script')

@endpush

@endsection