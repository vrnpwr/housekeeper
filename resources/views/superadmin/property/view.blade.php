@extends('layouts.superadmin')
@section('content')
@push('styles')
<link href="{{ asset('plugins/lightbox_2/dist/css/lightbox.css') }}" rel="stylesheet" />
<style type="text/css">
</style>
@endpush
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 mt-5">
        <h1 class="m-0 text-dark"><i class="fas fa-home mr-3"></i>Available Properties</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Properties</li>
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
          <div class="card-header">

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Owner Detail</th>
                  <th>Property Name</th>
                  <th style="width: 15%">Address</th>
                  <th>City</th>
                  <th>States</th>
                  <th>Images</th>
                  <th>Created At</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($properties as $key=>$property)
                <tr>
                  <td>
                    <span class="font-weight-bold">{{ $property->owner }}</span> <br>
                    <span class="small">{{ $property->owner_email }}</span>
                  </td>
                  <td>{{$property->property_name}}</td>
                  <td>{{$property->property_address}}</td>
                  <td>{{$property->city}}</td>
                  <td>{{$property->state}}</td>
                  <td>
                    {{-- image one --}}
                    @if(!is_null($property->property_image))
                    <a href=" {{ url('/images/'.$property->property_image) }}" data-lightbox="property_image"
                      data-title="property_{{$key+1}}">
                      <img src="{{ url('images/'.$property->property_image) }}" alt="Property image one" width="30">
                    </a>
                    @endif
                    @if(!is_null($property->property_image2))
                    <a href=" {{ url('/images/'.$property->property_image2) }}" data-lightbox="property_image"
                      data-title="property_{{$key+1}}">
                      <img src="{{ url('images/'.$property->property_image2) }}" alt="Property image two" width="30">
                    </a>
                    @endif
                    @if(!is_null($property->property_image3))
                    <a href=" {{ url('/images/'.$property->property_image3) }}" data-lightbox="property_image"
                      data-title="property_{{$key+1}}">
                      <img src="{{ url('images/'.$property->property_image3) }}" alt="Property image three" width="30">
                    </a>
                    @endif
                    @if(!is_null($property->property_image4))
                    <a href=" {{ url('/images/'.$property->property_image4) }}" data-lightbox="property_image"
                      data-title="property_{{$key+1}}">
                      <img src="{{ url('images/'.$property->property_image4) }}" alt="Property image four" width="30">
                    </a>
                    @endif
                    @if(!is_null($property->property_image5))
                    <a href=" {{ url('/images/'.$property->property_image5) }}" data-lightbox="property_image"
                      data-title="property_{{$key+1}}">
                      <img src="{{ url('images/'.$property->property_image5) }}" alt="Property image five" width="30">
                    </a>
                    @endif
                  </td>
                  <td>{{$property->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

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
<script src="{{ asset('plugins/lightbox_2/dist/js/lightbox.js') }}"></script>
<script>
  $(document).ready(function () {
  lightbox.option({
      'resizeDuration': 1000,
      'wrapAround': true
  })  
});
</script>
@endpush

@endsection