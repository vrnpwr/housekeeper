@extends('layouts.cleaner')
@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
  integrity="sha256-rByPlHULObEjJ6XQxW/flG2r+22R5dKiAoef+aXWfik=" crossorigin="anonymous" />
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

  .has-error {
    border: 1.5px solid tomato !important;
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
            <form method="post" action="/cleaner/information">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="{{ $names->name }}"
                      class="form-control{{ $errors->has('property_ids') ? ' has-error' : ''}}"
                      placeholder="first_name">
                    @error('first_name')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="{{ $names->last_name }}"
                      class="form-control" placeholder="first Name">
                    @error('last_name')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="website">wesite</label>
                    <input type="text" name="website" id="website" class="form-control"
                      placeholder="Website if you have any">
                    @error('website')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                {{-- Date of birth --}}
                <div class="col-4">
                  <div class="form-group">
                    <label for="date_of_birth">Date of birth</label>
                    <input type="text" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="">
                    @error('date_of_birth')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                {{-- Which Describe you best --}}
                <div class="col-5">
                  <div class="form-group">
                    <label for="">Which Describe you best</label>
                    <select name="describes" id="describes" class="form-control">
                      <option value="professional">I am a professional cleaner</option>
                      <option value="part_time">I am working part time as a cleaner</option>
                    </select>
                    @error('describes')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                {{-- Year of experience --}}
                <div class="col-3">
                  <div class="form-group">
                    <label for="experience">Years of experience</label>
                    <input type="number" name="experience" class="form-control" placeholder="">
                    @error('experience')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                {{-- Have accsess of Car --}}
                <div class="col-6">
                  <div class="form-group">
                    <label for="car_access">Do you have access to a car</label>
                    <select name="car_access" class="form-control" id="">
                      <option value="no">No</option>
                      <option value="yes">Yes</option>
                    </select>
                    @error('car_access')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">Have you ever convicted of a felony ?</label>
                    <select name="felony" id="felony" class="form-control">
                      <option value="no">No</option>
                      <option value="yes">Yes</option>
                    </select>
                    @error('felony')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                {{-- Travel --}}
                <div class="col-6">
                  <div class="form-group">
                    <label for="">How far are you willing to Travel (in miles)?</label>
                    <select name="travel" id="travel" class="form-control">
                      <option value="5">Up to 5 miles</option>
                    </select>
                    @error('travel')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                {{-- Vacation rentals --}}
                <div class="col-6">
                  <div class="form-group">
                    <label for="vacation_rentals">Have you cleaned vacation rentals before?</label>
                    <select name="vacation_rentals" id="vacation_rentals" class="form-control">
                      <option value="no">no</option>
                      <option value="yes">yes</option>
                    </select>
                    @error('vacation_rentals')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
  integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function () {
  $('#date_of_birth').on('click' , function (){
      $('#date_of_birth').datepicker({
        yearRange: "1950:2004",
        changeYear: true,
        changeMonth:true
      });
    })
 });
</script>
@endpush


@endsection