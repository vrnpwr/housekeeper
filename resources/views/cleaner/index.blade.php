@extends('layouts.cleaner')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ $title }}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard </li>
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
          <p>Your Profile Completed</p>
          @endif

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


@endsection