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
				<h1 class="m-0 text-dark"> Edit Property</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<!-- <li class="breadcrumb-item active">Add Property </li> -->
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

				<form  id="form">

					<div class="card card-primary card-outline card-outline-tabs">
						<div class="card-header p-0 border-bottom-0">
							<ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="general-tab" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="calender-tab" data-toggle="pill" href="#calender" role="tab" aria-controls="calender" aria-selected="false">Calenders</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="checklist-tab" data-toggle="pill" href="#checklist" role="tab" aria-controls="checklist" aria-selected="false">Checklists</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="cleaner-tab" data-toggle="pill" href="#cleaner" role="tab" aria-controls="cleaner" aria-selected="false">Cleaners</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="checkin-tab" data-toggle="pill" href="#checkin" role="tab" aria-controls="checkin" aria-selected="false">Check-in / Check-out</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="payments-tab" data-toggle="pill" href="#payments" role="tab" aria-controls="payments" aria-selected="false">Payments</a>
								</li>

							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content" id="custom-tabs-three-tabContent">


								<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
									@include('forms.property.edit_general')
								</div>


								<div class="tab-pane fade" id="calender" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
									<div class="row">
										<div class="col-3">

											<div class="form-group">
												<label>New Calender</label>
												<select class="form-control select2" style="width: 100%;">
													<option selected="selected">Alabama</option>
													<option>Alaska</option>
													<option>California</option>
													<option>Delaware</option>
													<option>Tennessee</option>
													<option>Texas</option>
													<option>Washington</option>
												</select>
											</div>
										</div><!-- Col-3 -->

										<div class="col-6">
											<div class="form-group">
												<label>Calender Link</label>
												<input type="text" class="form-control" name="calender-link">
											</div>
										</div><!-- col-6 -->

										<div class="col-3">
											<button class="btn btn-primary mt-4 ml-2">Add Calender</button>
										</div>

									</div>
								</div>

								<div class="tab-pane fade" id="checklist" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
									<h2>Checklist</h2>
								</div>

								<div class="tab-pane fade" id="cleaner" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
									<h2>Cleaners</h2>
								</div>


								<div class="tab-pane fade" id="checkin" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="check_in">Check In / Check Out</label>
												<input type="text" value="{{ $property->check_in }}" name="check_in" id="check_in" class="form-control timepicker">

											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="check_out">Check Out</label>
												<input type="text" name="check_out" value="{{ $property->check_out }}" id="check_out" class="form-control timepicker">
											</div>
										</div>
									</div>
								</div>


								<div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
									<h2>Payments</h2>
								</div>

							</div>
						</div>
						<!-- /.card -->

						<!-- Error Messages -->
						<div class="alert alert-danger print-error-msg" style="display:none">
							<ul></ul>
						</div>

					</div>
				</form>

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
		/*Color Picker*/
		$('.example').bcp();
		$('.example').on('pcb.refresh', function (e) {
			let color = $(this).bcp('color');
			var propertyColor = color.value;
			propertyColor = propertyColor ? propertyColor : "";
			$('#colorpicker-full').val(propertyColor);

			if (color.value) {
				$(this).css({
					backgroundColor: color.value,
					borderColor: color.value,
					color: color.dark ? '#fff' : '#000'
				});
			}
		});
		// timepicker
      $('.timepicker').mdtimepicker(); //Initializes the time picker

      $('#edit-property-btn').click(function(event) {
      	event.preventDefault();

      	var post_id = $('#post_id').val();
      	var user_id = $('#user_id').val();
      	var property_name = $('#property_name').val();
      	var property_address = $('#property_address').val();
      	var unit = $('#unit').val();
      	var access_code = $('#access_code').val();
      	var city = $('#city').val();
      	var state = $('#state').val();
      	var country = $('#country').val();
      	var zipcode = $('#zipcode').val();
      	var currency = $('#currency').val();
      	var colorpicker_full = $('#colorpicker-full').val();
      	var bedrooms = $('#bedrooms').val();
      	var bathrooms = $('#bathrooms').val();
      	var unit_of_measurement = $('#unit_of_measurement').val();
      	var size = $('#size').val();
      	var property_description = $('#property_description').val();
      	var property_image = $('#image_0').val();
      	var checklist_id = $('#checklist_id').val();
      	var check_in = $('#check_in').val();
      	var check_out = $('#check_out').val();


      	updateProperty(post_id,user_id, property_name, property_address, unit, access_code, city, state, country, zipcode, currency, colorpicker_full, bedrooms, bathrooms, unit_of_measurement, size, property_description, property_image, checklist_id, check_in, check_out);

      });



      /* Update Property Data*/
      function updateProperty(post_id, user_id, property_name, property_address, unit, access_code, city, state, country, zipcode, currency, colorpicker_full, bedrooms, bathrooms, unit_of_measurement, size, property_description, property_image, checklist_id, check_in, check_out){
      	var url='{{ url("property/update") }}';
      	$.ajax({
      		type: 'POST',
      		url: url,
      		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      		data:{post_id,user_id, property_name, property_address, unit, access_code, city, state, country, zipcode, currency, colorpicker_full, bedrooms, bathrooms, unit_of_measurement, size, property_description, property_image, checklist_id, check_in, check_out},
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
      					$(".print-error-msg").css('display','none');
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

	/* Form Validation */

	

	/* ############### FILE POND ##################### */


</script>

@endpush

@endsection
