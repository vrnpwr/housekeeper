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

  .required {
    color: tomato;
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

            <div class="row">
              <div class="col-12">
                <h4>References</h4>
                <p>Please Submit one or more references below from vacation rental owners/property managers that you
                  have previous cleaned for.</p>
                <p><b class="text-danger">You must have atleast one reference respond, or your application will not be
                    accepted </b></p>
              </div>
            </div>
            {{-- Form --}}
            <form action="/cleaner/reference/create" method="post">
              {{ csrf_field() }}
              @if(!$hasReference)
              <div class="row">
                <div class="col-3">
                  <div class="form-group">
                    <label for="">Name</label><span class="required">*</span>
                    <input type="text" name="name" id="name"
                      class="form-control{{ $errors->has('name') ? ' has-error' : ''}}" placeholder="Name">
                    @error('name')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group">
                    <label for="">Email</label><span class="required">*</span>
                    <input type="text" name="email" id="email"
                      class="form-control{{ $errors->has('email') ? ' has-error' : ''}}" placeholder="Email">
                    @error('email')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group">
                    <label for="">Phone</label><span class="required">*</span>
                    <input type="number" name="phone" id="phone"
                      class="form-control{{ $errors->has('phone') ? ' has-error' : ''}}" placeholder="Phone">
                    @error('phone')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                {{-- <div class="col-3">
                        <div class="form-group">
                          <button class="btn btn-primary mt-4 ml-5 add-references"><i class="fas fa-plus"> <span
                            class="ml-1">Add</span></i></button>
                          </div>
                        </div> --}}
              </div>

              {{-- <div class="row-container"></div> --}}
              <!-- Submit Button -->
              <div class="row">
                <div class="col-12">
                  <input type="submit" class="btn btn-info float-right mt-5" value="Submit" />
                </div>
              </div>
              @else
              <div class="row-container" style="display: none;">
                <div class="row this-row">
                  <div class="col-3">
                    <div class="form-group">
                      <label for="">Name</label><span class="required">*</span>
                      <input type="text" name="name" id="name"
                        class="form-control{{ $errors->has('name') ? ' has-error' : ''}}" placeholder="Name">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="">Email</label><span class="required">*</span>
                      <input type="text" name="email" id="email"
                        class="form-control{{ $errors->has('email') ? ' has-error' : ''}}" placeholder="Email">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="">Phone</label><span class="required">*</span>
                      <input type="text" name="phone" id="phone"
                        class="form-control{{ $errors->has('phone') ? ' has-error' : ''}}" placeholder="Phone">
                    </div>
                  </div>
                  <div class="col-3">
                    <input type="submit" class="btn btn-success mt-4" value="save" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-3">
                  <div class="form-group">
                    <button class="btn btn-primary mt-4 ml-5 add-references"><i class="fas fa-plus"> <span
                          class="ml-1">Add More Reference</span></i></button>
                  </div>
                </div>

                <div class="col-3">
                  <div class="form-group">
                    <button class="btn btn-success mt-4 ml-5 skip">Don't have
                      more refrence</button>
                  </div>
                </div>

                {{-- <div class="col-6 text-center ">
                  <input type="submit" class="btn btn-success mt-3" value="save" />
                </div> --}}
              </div>
              @endif
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
<script>
  $('.add-references').on('click' , function(e) {
            e.preventDefault();
            $('.row-container').show();
            });
            
            setInterval(function() {
              $('.remove-references').on('click' , function() {
                $(this).closest('div.this-row').remove();
              });            
            },1000)

        $('.skip').on('click' , function() {
          window.location.href = '/cleaner/dashboard';
        })
            
</script>
@endpush


@endsection