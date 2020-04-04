@extends('layouts.admin')

@section('content')


@push('styles')

<style type="text/css">
	.add-property{
		float: right;
	}
</style>


@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Project</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Project </li>
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
						<h3 class="card-title">Project List</h3>
						<div class="add-property">
							<a href="{{ url('/project/create') }}" class="btn btn-primary">Add Project</a>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div class="card card-primary card-outline card-outline-tabs">
							<div class="card-header p-0 border-bottom-0">
								<ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="pending-tab" data-toggle="pill" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="accepted-tab" data-toggle="pill" href="#accepted" role="tab" aria-controls="accepted" aria-selected="false">Accepted</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="cancel-tab" data-toggle="pill" href="#cancel" role="tab" aria-controls="cancel" aria-selected="false">Cancelled</a>
									</li>


								</ul>
							</div>
							<div class="card-body">
								<div class="tab-content" id="custom-tabs-three-tabContent">


									<div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

										<!-- /.card-body -->

										@if(!count($pendings) >= 1)
										@foreach($pendings as $key=>$value)
										@foreach($value as $key=>$pending)

										<div class="card-footer mt-2 mb-2">
											<!-- dates and timming Details -->
											<h5 class="lead">{{ $pending->dates_timmings }}</h5>
											<!-- property Name -->
											<h6 class="font-weight-bold">{{ $pending->property_name }}</h6>
											<!-- Publish Status -->
											@if($pending->publish_project == 1)
											<h6 class="font-weight-bold">published</h6>
											@else
											<h6 class="font-weight-bold">Pending</h6>											
											@endif
											<!-- Delete -->
											<a href="#" class="btn btn-default float-right ml-2 delete" data-id="{{ $pending->id }}"><i class="fas fa-trash"></i></a>
											<!-- Edit -->
											<a href="{{ url('/project/'.$pending->id.'/edit') }}" class="btn btn-default float-right"><i class="fas fa-edit"></i></a>
										</div>

										@endforeach
										@endforeach

										@else
										@foreach($pendings as $key=>$pending)
										<div class="card-footer mt-2 mb-2">
											<!-- dates and timming Details -->
											<h5 class="lead">{{ $pending[0]->dates_timmings }}</h5>
											<!-- property Name -->
											<h6 class="font-weight-bold">{{ $pending[0]->property_name }}</h6>
											<!-- Publish Status -->
											@if($pending[0]->publish_project == 1)
											<h6 class="font-weight-bold">published</h6>
											@else
											<h6 class="font-weight-bold">Pending</h6>											
											@endif
											<!-- Delete -->
											<a href="#" class="btn btn-default float-right ml-2 delete" data-id="{{ $pending[0]->id }}"><i class="fas fa-trash"></i></a>
											<!-- Edit -->
											<a href="{{ url('/project/'.$pending[0]->id.'/edit') }}" class="btn btn-default float-right"><i class="fas fa-edit"></i></a>
										</div>
										@endforeach

										
										@endif

										<!-- /.card-footer-->
										<!-- /.card -->


									</div>

									<div class="tab-pane fade" id="accepted" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
										<div class="row">
											<h2>Accepted</h2>
										</div>
									</div>

									<div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
										<div class="row">											
											<h2>Cancelled</h2>
										</div>
									</div>
								</div>
							</div>
							<!-- /.card -->

							<!-- Error Messages -->
							<div class="alert alert-danger print-error-msg" style="display:none">
								<ul></ul>
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
<script type="text/javascript">
	            // Delete Function 
	            setInterval(function(){

	            	$(".delete").on("click",function(e){
	            		e.preventDefault();    

	            		Swal.fire({
	            			title: 'Are you sure?',
	            			text: "You won't be able to revert this!",
	            			icon: 'warning',
	            			showCancelButton: true,
	            			confirmButtonColor: '#3085d6',
	            			cancelButtonColor: '#d33',
	            			confirmButtonText: 'Yes, delete it!'
	            		}).then((result) => {
	            			if (result.value) {
	            				var id = $(this).data("id");
	            				console.log("post ID is "+ id);
	            				var token = $("meta[name='csrf-token']").attr("content");
	            				$.ajax(
	            				{
	            					url: "project/"+id,
	            					type: 'DELETE',
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
