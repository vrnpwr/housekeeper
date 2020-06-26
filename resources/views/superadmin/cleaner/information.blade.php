@extends('layouts.superadmin')
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
        <h1 class="m-0 text-dark"><i class="fas fa-broom mr-3"></i>Cleaner Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Cleaner information </li>
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
            References and Identity information of <b>{{ $cleanerName}}</b>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            {{-- References Table --}}
            <table id="" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Reference Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $references->name }}</td>
                  <td>{{ $references->email }}</td>
                  <td>{{ $references->phone }}</td>
                </tr>
                @if(!is_null($references->name1))
                <tr>
                  <td>{{ $references->name1 }}</td>
                  <td>{{ $references->email1 }}</td>
                  <td>{{ $references->phone1 }}</td>
                </tr>
                @endif
              </tbody>
            </table>
            {{-- Identity Proofs --}}
            <div class="row mt-3">
              <div class="col-3">
                <div class="form-group">
                  <label class="d-block">Identity Front</label>
                  <img src="{{ url('images/'.$identityFront) }}" alt="" width="150">
                </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label class="d-block">Identity Back</label>
                  <img src="{{ url('images/'.$identityBack) }}" alt="" width="150">
                </div>
              </div>
              <div class="col-3 mt-5">
                <button type="button"
                  class="btn btn-success @if($status == 'disapprove') approve @endif @if($status == 'approve') disabled  @endif"
                  data-id="{{$id}}">Approve</button>
              </div>

              <div class="col-3 mt-5">
                <button type="button"
                  class="btn btn-danger @if($status == 'approve') disapprove @endif    @if($status == 'disapprove') disabled  @endif"
                  data-id="{{$id}}">Disapprove</button>
              </div>

            </div>
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
  // Delete Function 
	setInterval(function(){
// Remove Invitation
$(".approve").on("click",function(e){
	e.preventDefault();    
	Swal.fire({
		title: 'Are you sure?',
		text: "You want to approve this cleaner",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes'
	}).then((result) => {
		if (result.value) {
			var id = $(this).data("id");
			var token = $("meta[name='csrf-token']").attr("content");
			$.ajax(
			{
				url: "/admin/approve_cleaner/",
				type: 'post',
				data: {
					"id": id,
					"_token": token,
				},
				success:function(data){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Your work has been saved',
						showConfirmButton: false,
						timer: 1500
					})
					.then(() => {
						$('div.flash-message').html(data);
						window.location.reload();
					})

				},          
				error: function (jqXHR, textStatus, errorThrown) 
				{  
					swal.fire({
						title: "Something error",
						text: "Check input fields!",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
				}
			});
		}
	})	
});
$(".disapprove").on("click",function(e){
	e.preventDefault();    
	Swal.fire({
		title: 'Are you sure?',
		text: "You want to Disapprove this cleaner",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes'
	}).then((result) => {
		if (result.value) {
			var id = $(this).data("id");
			var token = $("meta[name='csrf-token']").attr("content");
			$.ajax(
			{
				url: "/admin/disapprove_cleaner/",
				type: 'post',
				data: {
					"id": id,
					"_token": token,
				},
				success:function(data){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Your work has been saved',
						showConfirmButton: false,
						timer: 1500
					})
					.then(() => {
						$('div.flash-message').html(data);
						window.location.reload();
					})

				},          
				error: function (jqXHR, textStatus, errorThrown) 
				{  
					swal.fire({
						title: "Something error",
						text: "Check input fields!",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
				}
			});
		}
	})	
});
},1000);
</script>
@endpush

@endsection