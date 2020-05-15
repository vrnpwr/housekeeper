@extends('layouts.admin')

@section('content')


@push('styles')

<style type="text/css">
	.add-property {
		float: right;
	}
</style>


@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Property</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Property </li>
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
						<h3 class="card-title">Propert List</h3>
						<div class="add-property">
							<a href="{{ url('/property/create') }}" class="btn btn-primary">Add Property</a>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Property Name</th>
									<th>Property Address</th>
									<th>Action</th>

								</tr>
							</thead>
							<tbody>
								@foreach($properties as $key=>$property)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $property->property_name }}</td>
									<td>{{ $property->property_address }}</td>
									<td>
										<!-- Edit -->
										<a href="{{ url('/property/'.$property->id.'/edit') }}" class="btn btn-success">
											<i class="fa fa-edit" aria-hidden="true"></i>
										</a>
										<!-- Delete -->
										<a href="#" class="btn btn-danger delete mr-3" data-id="{{$property->id}}">
											<i class="fa fa-trash" aria-hidden="true"></i>
										</a>
										<!-- <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
											<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button> -->
									</td>
								</tr>
								@endforeach

							</tbody>
							<tfoot>
								<tr>
									<th>Sr. No.</th>
									<th>Property Name</th>
									<th>Property Address</th>
									<th>Action</th>

								</tr>
							</tfoot>
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
	            					url: "property/"+id,
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
	            							// window.location.reload();
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