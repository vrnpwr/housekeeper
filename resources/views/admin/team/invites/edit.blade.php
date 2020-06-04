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
          <div class="">
            <form method="post" action="{{ route('invite.update', $invite->id) }}">
              @method('PATCH')
              @csrf
              <div class="row">
                <div class="col-12">
                  <div class="select2-purple">
                    <label>Select the properties you want to share with this cleaner.</label>
                    <select name="property_ids" class="properties {{ $errors->has('property_ids') ? ' has-error' : ''}}"
                      multiple="multiple" data-placeholder="Select Cleaners" style="width: 100%;">
                      @foreach($properties as $key=>$property)
                      <option value="{{ $property->id }}" @if(in_array($property->id ,
                        json_decode($invite->property_ids)) ) selected="selected" @endif >{{ $property->property_name }}
                      </option>
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
                    <select name="invitation_type{{ $errors->has('invitation_type') ? ' has-error' : ''}}"
                      class="custom-select" name="invitation-type">
                      <option>Select type</option>
                      <option value="email" @if($invite->invitation_type == "email") selected="selected" @endif >Email
                      </option>
                      <option value="phone" @if($invite->invitation_type == "phone") selected="selected" @endif>Phone
                      </option>

                    </select>
                    @error('invitation_type')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="">Name</label>
                    <input name="cleaner_name" type="text" name="name" value="{{ $cleaner }}"
                      class="form-control{{ $errors->has('cleaner_name') ? ' has-error' : ''}}"
                      placeholder="Enter Cleaner Name">
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
                  </div>
                </div>
                {{-- Submit Button --}}
                <div class="form-group">
                  <button type="submit" class="btn btn-primary ml-1">Submit</button>
                </div>
              </div>
            </form>
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
  $(document).ready(function () {
    $('.properties').select2();
  });
</script>
@endpush


@endsection