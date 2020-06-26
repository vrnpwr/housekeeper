@extends('layouts.superadmin')

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
    <div class="row">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h6>Total Properties <small class="font-weight-bold ml-1"
                style="font-size:1.6em;">{{ $properiesCount }}</small>
            </h6>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ url('/property') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- Checklist -->
      <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h6>Checklists <small class="font-weight-bold ml-1" style="font-size:1.6em;">{{ $checklistCount }}</small>
            </h6>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ url('/mychecklists') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- Property -->
      <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h6>Total Projects <small class="font-weight-bold ml-1" style="font-size:1.6em;">{{ $projectCount }}</small>
            </h6>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ url('/project') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>

    {{-- For cleaner and hosts --}}
    <div class="row">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h6>Total Hosts Registered <small class="font-weight-bold ml-1"
                style="font-size:1.6em;">{{ $hosts }}</small>
            </h6>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ url('/property') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- Checklist -->
      <div class="col-lg-4 col-6">
        <div class="small-box bg-default">
          <div class="inner">
            <h6>Total Cleaners Registered <small class="font-weight-bold" ml-1
                style="font-size:1.6em;">{{ $cleaners }}</small>
            </h6>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ url('/mychecklists') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- Property -->
      <div class="col-lg-4 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h6>Inactive Cleaners <small class="font-weight-bold" ml-1
                style="font-size:1.6em;">{{ $inactiveCleaner }}</small>
            </h6>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ url('/project') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
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