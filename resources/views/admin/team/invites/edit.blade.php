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
            <form wire:submit.prevent="edit">
              <div class="row">
                {{-- Formlive wire testing --}}
                <div class="col-12">
                  <div class="" wire:ignore class="w-full select2-purple">
                    <label>Select the properties you want to share with this cleaner.</label>
                    <select class="properties" multiple="multiple" data-placeholder="Select Cleaners"
                      style="width: 100%;">
                      @foreach($properties as $key=>$pro)
                      <option @if($invite->id == $pro->id) value="{{ $pro->id }}" selected @else
                        value="{{ $pro->id }}" @endif
                        >{{ $pro->property_name }}</option>
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
                    <select wire:model="invitation_type" class="custom-select" name="invitation-type">
                      <option selected>Select type</option>
                      <option value="email">Email</option>
                      <option value="phone">Phone</option>

                    </select>
                    @error('invitation_type')
                    <span class="text-sm text-danger error">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="">Name</label>
                    <input wire:model="cleaner_name" type="text" name="name" class="form-control"
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
                      <input type="email" wire:model="details" class="form-control" placeholder="Enter Email">
                      @error('details')
                      <span class="text-sm text-danger error">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="my-input">Invitation Message</label>
                    <input class="form-control" type="text" wire:model="invitation_message">
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

</script>
@endpush


@endsection