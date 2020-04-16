@extends('layouts.admin')

@section('content')


@push('styles')

<style type="text/css">
	.add-property {
		float: right;
	}

	.mdtp__wrapper {
		bottom: 120px !important;
	}
</style>


@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark"> Add Checklist</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Add Checklist </li>
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
				<div class="card card-primary">
					<div class="card-body">
						<!-- #############Form Area########### -->

						<form id="form">

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input type="hidden" value="{{ $user->id }}" id="user_id" name="user_id">
										<label for="title">Title <span class="required">*</span></label>
										<input type="text" value="" name="title" id="title" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="description">Description</label>
										<textarea name="description" id="description" class="form-control"></textarea>
									</div>
								</div>
							</div>



							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>Property</label>
										<div class="select2-purple">
											<select id="property_id" class="select2" name="property_id[]" multiple="multiple"
												data-placeholder="Select Property" data-dropdown-css-class="select2-purple"
												style="width: 100%;">
												@foreach($properties as $key=>$property)
												<option value="{{ $property->id }}">{{ $property->property_name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<!-- /.form-group -->
								</div>

								<div class="col-4 mt-5">
									<!-- Public option -->
									<input type="checkbox" class="is_public" id="is_public" value="1">
									<label>Make Checklist Public</label>
								</div>

								<div class="col-2">
									<button type="button" class="add_new btn btn-success mt-4"><i class="fas fa-plus"></i></button>
								</div>

							</div>

							<div class="list_items">
								<div class="row" id="toCopy">
									<div class="col-md-3">
										<label>Title</label>
										<input type="text" name="item_title[]" class="form-control">
									</div>
									<div class="col-md-4">
										<label>Description</label>
										<textarea name="item_description[]" class="form-control"></textarea>
									</div>

									<div class="col-md-3">
										<label>Image</label>
										<label>Property Image</label>
										<input type="file" name="image">
										<input type="hidden" class="item_image_hidden" name="" id="image_0" value="">

									</div>
									<div class="col-md-2">
										<button type="button" class="remove-btn btn btn-danger mt-4"><i
												class="fas fa-trash-alt"></i></button>

									</div>

								</div>
								<div id="container">

								</div>
							</div>

							<div class="row">
								<div class="col-12">
									<button class="btn btn-success float-right" id="checklist-btn">Submit</button>
								</div>

								<!-- Error Messages -->
								<div class="alert alert-danger print-error-msg" style="display:none">
									<ul></ul>
								</div>
							</div>

						</form>
						<!-- #############Form Area########### -->
					</div>
				</div>
			</div>
		</div>

	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


@push('script')

<script>
	$(document).ready(function($) {
	//Initialize Select2 Elements
	$('.select2').select2();

	//Initialize Select2 Elements
	$('.select2bs4').select2({
		theme: 'bootstrap4'
	});
	/* Add Multiple Chek Items*/
	$('.add_new').on('click', function(){
		let count = $('.item_image_hidden').length;
		$('#container').append(`<div class="row"><div class="col-md-3"><label>Title</label><input type="text" name="item_title[]" class="item_title form-control"></div><div class="col-md-4"><label>Description</label><textarea name="item_description[]" class="item_description form-control"></textarea></div><div class="col-md-3"><label>Image</label>
			<label>Property Image</label><input type="file" name="image">

			<input type="hidden" class="item_image_hidden" name="item_image[]" id="image_${count}" value="">

			</div><div class="col-md-2"><button type="button" class="remove-btn btn btn-danger mt-4"><i class="fas fa-trash-alt"></i></button></div></div>`);

		PondManager.init();
	});

	/*###################################Filepond###################################*/


	/*Filepond*/    
	/* Add Multiple Chek Items*/
	setInterval(function(){
		$(".remove-btn").on('click',function(){
			var current = $(this).parent().parent().remove();
			// console.log(current);
		});
	},1000);


	$('#checklist-btn').click(function(event) {
		event.preventDefault();

		let collectImages = [];
		$('.item_image_hidden').each((k,e)=>{
			collectImages.push($(e).val());
		});

		// sweet alert    
		var user_id = $('#user_id') .val();
		var title = $('#title').val();
		var description = $('#description').val();
		var property_id = $('#property_id').val();
		var check = $('#is_public').is(':checked');
		
		/*save zero if user not select make pulic option*/
		if (check == true) {
			var is_public = 1;			
		}else{
			var is_public = 0;
		}

		var item_image = collectImages;
		var item_title = $("input[name='item_title\\[\\]']").map(function(){return $(this).val();}).get();
		var item_description = $("textarea[name='item_description\\[\\]']").map(function(){return $(this).val();}).get();
		insertChecklist(user_id, title, description, property_id, is_public, item_title, item_description,item_image);
	});
	/* Insert Property Data*/
	function insertChecklist(user_id, title, description, property_id, is_public, item_title, item_description,item_image){

		$.ajax({
			type: 'POST',
			url: '{{ action('CheckListController@store') }}',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data:{user_id, title, description, property_id, is_public, item_title, item_description,item_image},
			success:function(data){
				if($.isEmptyObject(data.error)){

					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Your work has been saved',
						showConfirmButton: false,
						timer: 1500
					})
					.then(() => {
						window.location.reload();
					})

				}else{
					console.log(data.error);
					printErrorMsg(data.error);
				}

			},

			error: function (jqXHR, textStatus, errorThrown) 
			{  
				swal({
					title: "Something error",
					text: "Check input fields!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
			}

		})
	}

	function printErrorMsg (msg) {
		$(".print-error-msg").find("ul").html('');
		$(".print-error-msg").css('display','block');
		$.each( msg, function( key, value ) {
			$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
		});
	}


});




</script>

@endpush

@endsection