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
        <h1 class="m-0 text-dark"><i class="fas fa-broom mr-3"></i>Available Cleaners</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Cleaners</li>
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Registered on</th>
                  <th>Details</th>
                  {{-- <th>Action</th> --}}
                </tr>
              </thead>
              <tbody>
                @foreach ($cleaners as $key=>$cleaner)
                <tr>
                  <td>{{$cleaner->name .' '. $cleaner->last_name}}</td>
                  <td>{{$cleaner->email}}</td>
                  <td>{{$cleaner->status}}</td>
                  <td>{{$cleaner->created_at->diffForHumans() }}</td>
                  <td>
                    @if ($cleaner->details == 'available')
                    <a href="{{ url('/admin/cleaner/details/'.$cleaner->id) }}" data-id="{{ $cleaner->id }}">
                      <button type="button" class="btn btn-default btn-sm mr-1"><i
                          class="fas mr-1 fa-info"></i>Details</button>
                    </a>
                    @else
                    <button type="button" class="btn btn-default btn-sm disabled mr-1"><i
                        class="fas mr-1 fa-info"></i>Details</button>
                    @endif
                  </td>
                  {{-- <td>
                    <button
                      class="btn btn-default btn-sm mr-1 @if($cleaner->status == 'not_approve') approve @endif @if($cleaner->status == 'approve') disabled  @endif"><i
                        class="far mr-1 fa-thumbs-up fa-lg"></i>Approve</button>
                    <button
                      class="btn btn-default btn-sm mr-1 @if($cleaner->status == 'approve') disapprove @endif    @if($cleaner->status == 'not_approve') disabled  @endif"><i
                        class="far mr-1 fa-thumbs-down fa-lg"></i>Disapprove</button>
                  </td> --}}
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
<script>
  // Delete Function 
	setInterval(function(){
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