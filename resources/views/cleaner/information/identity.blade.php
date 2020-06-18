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
          <li class="breadcrumb-item active">General Information</li>
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
    {{-- <div class="card"> --}}
    <form action="/cleaner/identity/create" method="post">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-body">
              {{-- Identification coloumn --}}
              <div class="row">
                <div class="col-4">
                  <h4>Identification</h4>
                  <p>We need to verify your Identity to assure customer that You are who you say you are.
                    Please upload a pitcure of your photo Id. Acceptable forms of photo Ids are a Valid driving licence
                    or
                    a
                    valid passport.</p>
                  <p><b>Your Identification documents will not be shared with any third</b></p>
                </div>
                {{-- Front --}}
                <div class="col-4">
                  <div class="form-group mt-5" id="filepond-block">
                    <label for="front_proof">Identity Front</label>
                    <input type="file" name="image">
                    <input type="hidden" id="image_0" name="identy_front">

                  </div>
                </div>
                {{-- Back --}}
                <div class="col-4">
                  <div class="form-group mt-5" id="filepond-block">
                    <label for="back_proof">Identity Back</label>
                    <input type="file" name="image">
                    <input type="hidden" id="image_1" name="identy_back">
                  </div>
                </div>
              </div>

              <!-- Submit Button -->
              <div class="row">
                <div class="col-12">
                  <input type="submit" class="btn btn-info float-right mt-5" value="Next" />
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </form>
    {{-- </div> --}}
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