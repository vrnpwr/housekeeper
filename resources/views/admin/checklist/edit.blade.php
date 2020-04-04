@extends('layouts.admin')

@section('content')


@push('styles')

<style type="text/css">
	.add-property{
		float: right;
	}

	.mdtp__wrapper {bottom: 120px!important;}
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
			<div class="card-body">
				<div class="col-12">

					<!-- #############Form Area########### -->

					<form id="form">

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="hidden" value="{{ $checklist->id }}" id="post_id" name="post_id">
									<input type="hidden" value="{{ $user->id }}" id="user_id" name="user_id">
									<label for="title">Title <span class="required">*</span></label>
									<input type="text" value="{{ $checklist->title }}" name="title" id="title" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="description">Description</label>
									<textarea name="description" id="description" class="form-control">{{ $checklist->description }}</textarea>
								</div>
							</div>
						</div>



						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label>Property</label>
									<div class="select2-purple">
										<select id="property_id" class="select2" name="property_id[]" multiple="multiple" data-placeholder="Select Property" data-dropdown-css-class="select2-purple" style="width: 100%;">
											@if(!empty($selected_properties))
											@foreach($selected_properties as $key=>$property)
											<option value="{{ $property->id }}" selected>
												{{ $property->property_name }}
											</option>
											@endforeach
											@endif
											<!-- All Properties -->
											@foreach($properties as $key=>$value)
											<option value="{{ $value->id }}">
												{{ $value->property_name }}
											</option>
											@endforeach
										</select>
									</div>
								</div>
								<!-- /.form-group -->
							</div>

							<div class="col-4 mt-5">
								<!-- Public option -->
								@if($checklist->public == 1)
								<input type="checkbox" class="is_public" checked="" id="is_public" value="1">
								@else
								<input type="checkbox" class="is_public" id="is_public" value="1">
								@endif
								<label>Make Checklist Public</label>

							</div>
							<div class="col-2">								
								<button type="button" class="add_new btn btn-success mt-4"><i class="fas fa-plus"></i></button>
							</div>

						</div>

						<div class="list_items">
							<?php 
							$description =  json_decode($checklist->item_description); 
							$image = json_decode($checklist->item_image);

							?>

							@if( is_array(json_decode($checklist->item_title)) )	
							@foreach(json_decode($checklist->item_title) as $key=>$value)

							<div class="row mt-3">
								<div class="col-3">
									<label>Title</label>
									<input type="text" value="{{ $value }}" name="item_title[]" class="form-control">
								</div>
								<div class="col-4">
									<label>Description</label>
									<textarea name="item_description[]" class="form-control">{{ $description[$key] }}</textarea>
								</div>

								<div class="col-3">
									<label>Image</label>
									@if(empty($image[$key]) )
									<img src="{{ asset('images/placeholder/checklist.png') }}" class="ml-md-5" style=" height: 100px;">
									<!-- This block will use when we delete image sepratelly -->
									<div class="" id="filepond-block" style="display: none;">									
										<input type="file" name="image">
										<input type="hidden" class="item_image_hidden" name="item_image[]" id="image_${count}" value="">
									</div>
									<!-- This block will use when we delete image sepratelly -->
									@else
									<img src="{{ asset('images/'.$image[$key]) }}" class="ml-md-5" style=" height: 100px;">
									<input type="hidden" value="{{ $image[$key] }}" id="image_0" name="item_image[]">
									@endif
								</div>
								<div class="col-2">
									<button type="button" class="remove-btn btn btn-danger mt-4"><i class="fas fa-trash-alt"></i></button>
									<!-- aDD bUTTON -->

								</div>
							</div>

							@endforeach
							@endif
							<div  id="container">

							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<button class="btn btn-success float-right" id="checklist-btn">Update</button>
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

		setInterval(function(){
			$(".remove-btn").on('click',function(){
				var current = $(this).parent().parent().remove();
			// console.log(current);
		});
		},1000);


	//Initialize Select2 Elements
	$('.select2').select2()

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
    /* Add Multiple Chek Items*/
    setInterval(function(){
    	$(".remove-btn").on('click',function(){
    		var current = $(this).parent().parent().remove();
    		// console.log(current);
    	});
    },1000);


    $('#checklist-btn').click(function(event) {
    	event.preventDefault();

      // sweet alert    
      var post_id = $("#post_id").val();
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

      var item_image = $("input[name='item_image\\[\\]']").map(function(){return $(this).val();}).get();
      var item_title = $("input[name='item_title\\[\\]']").map(function(){return $(this).val();}).get();
      var item_description = $("textarea[name='item_description\\[\\]']").map(function(){return $(this).val();}).get();

      insertChecklist(post_id, user_id, title, description, property_id, item_image, item_title, item_description);
  });
    /* Insert Property Data*/
    function insertChecklist(post_id, user_id, title, description, property_id, item_image, item_title, item_description){
    	var url='{{ url("mychecklists/update") }}';
    	$.ajax({
    		type: 'POST',
    		url: url,
    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    		data:{post_id, user_id, title, description, property_id, item_image, item_title, item_description},
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
