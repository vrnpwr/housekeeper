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

  .points {
    margin: 0px !important;
    padding: 0px !important;
    font-weight: 600;
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
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-body">
            {{-- Identification coloumn --}}
            <form action="/cleaner/profile_photo/create" method="post">
              <div class="row">
                <div class="col-8">
                  <h4>Picture</h4>
                  <p>This is the picture potential customer will see. Only picture that meet these rules will be
                    allowed,
                    your application will not be approved without valid picture.</p>
                  <p class="points">1. No logo or text.</p>
                  <p class="points">2. Face Centered.</p>
                  <p class="points">3. Only One person.</p>
                  <p class="points">4. Neck and up only.</p>
                  <p class="points">5. Bright and clear.</p>
                  <p class="points">6. Unclutter backgroud.</p>
                </div>
                {{-- Front --}}
                {{ csrf_field() }}
                <div class="col-4">
                  <div class="form-group mt-5" id="filepond-block">
                    <label for="front_proof">Picture</label>
                    <input type="file" name="image">
                    <input type="hidden" id="image_0">
                  </div>
                </div>
              </div>

              <!-- Submit Button -->
              <div class="row">
                <div class="col-12">
                  <input type="submit" class="btn btn-info float-right mt-5" value="Next" />
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
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