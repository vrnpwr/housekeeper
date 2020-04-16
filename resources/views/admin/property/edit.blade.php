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

	/* ############The switch - the box around the slider############ */
	.switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 34px;
		float: right;
	}

	/* Hide default HTML checkbox */
	.switch input {
		display: none;
	}

	/* The slider */
	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 26px;
		width: 26px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}

	input.default:checked+.slider {
		background-color: #444;
	}

	input.primary:checked+.slider {
		background-color: #2196F3;
	}

	input.success:checked+.slider {
		background-color: #8bc34a;
	}

	input.info:checked+.slider {
		background-color: #3de0f5;
	}

	input.warning:checked+.slider {
		background-color: #FFC107;
	}

	input.danger:checked+.slider {
		background-color: #f44336;
	}

	input:focus+.slider {
		box-shadow: 0 0 1px #2196F3;
	}

	input:checked+.slider:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
		border-radius: 34px;
	}

	.slider.round:before {
		border-radius: 50%;
	}

	/* ############The switch - the box around the slider############ */
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

				<form id="form">

					<div class="card card-primary card-outline card-outline-tabs">
						<div class="card-header p-0 border-bottom-0">
							<ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="general-tab" data-toggle="pill" href="#general" role="tab"
										aria-controls="general" aria-selected="true">General</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="calender-tab" data-toggle="pill" href="#calender" role="tab"
										aria-controls="calender" aria-selected="false">Calenders</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="checklist-tab" data-toggle="pill" href="#checklist" role="tab"
										aria-controls="checklist" aria-selected="false">Checklists</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="cleaner-tab" data-toggle="pill" href="#cleaner" role="tab"
										aria-controls="cleaner" aria-selected="false">Cleaners</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="checkin-tab" data-toggle="pill" href="#checkin" role="tab"
										aria-controls="checkin" aria-selected="false">Check-in / Check-out</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="payments-tab" data-toggle="pill" href="#payments" role="tab"
										aria-controls="payments" aria-selected="false">Payments</a>
								</li>

							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content" id="custom-tabs-three-tabContent">


								<div class="tab-pane fade show active" id="general" role="tabpanel"
									aria-labelledby="custom-tabs-three-home-tab">
									@include('forms.property.edit_general')
								</div>


								<div class="tab-pane fade" id="calender" role="tabpanel"
									aria-labelledby="custom-tabs-three-profile-tab">
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

								<div class="tab-pane fade" id="checklist" role="tabpanel"
									aria-labelledby="custom-tabs-three-messages-tab">
									<h2>Checklist</h2>

									<div class="col-md-12">
										<div class="card" style="margin:50px 0">
											<!-- Default panel contents -->
											@if(!$property->checklist_id)
											<div class="card-body" class="alert-box">

												<div class="alert alert-warning alert-dismissible">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
													<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
													You did not have any Checklist for this Property.
												</div>

											</div>
											@endif
											<div class="card-header">Checkbox to Round Switch</div>

											<ul class="list-group list-group-flush">
												@foreach($checklists as $key=>$value)
												<li class="list-group-item">
													{{ $value->title }}
													<label class="switch ">
														@if($value->id == $property->checklist_id && $property->checklist_id)
														<input value="{{ $value->id }}" checked="" id="checklist_id" name="checklist_id[]"
															type="radio" class="checklist-radio default">
														@else
														<input value="{{ $value->id }}" id="checklist_id" name="checklist_id[]" type="radio"
															class="checklist-radio default">
														@endif
														<span class="slider round"></span>
													</label>
												</li>
												@endforeach
											</ul>
										</div>



									</div>



								</div>

								<div class="tab-pane fade" id="cleaner" role="tabpanel"
									aria-labelledby="custom-tabs-three-settings-tab">
									<h2>Cleaners</h2>
								</div>


								<div class="tab-pane fade" id="checkin" role="tabpanel"
									aria-labelledby="custom-tabs-three-settings-tab">

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="check_in">Check In / Check Out</label>
												<input type="text" value="{{ $property->check_in }}" name="check_in" id="check_in"
													class="form-control timepicker">

											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="check_out">Check Out</label>
												<input type="text" name="check_out" value="{{ $property->check_out }}" id="check_out"
													class="form-control timepicker">
											</div>
										</div>
									</div>
								</div>


								<div class="tab-pane fade" id="payments" role="tabpanel"
									aria-labelledby="custom-tabs-three-settings-tab">
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

	/* Below code save the checklist only one checklist will save for one property */
	$('.checklist-radio').on('change',function(event) {
		event.preventDefault();
		var check = $(this).is(':checked');
		if (check) {	
			var user_id = $('#user_id').val();
			var post_id = $('#post_id').val();
			var checklist_id = this.value;
			updateChecklist(post_id,user_id, checklist_id);
		}
	});

	function updateChecklist(post_id,user_id, checklist_id){
		var url='{{ url("property/update/checklist") }}';
		$.ajax({
			type: 'POST',
			url: url,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data:{post_id,user_id, checklist_id},
			success:function(data){
				const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					onOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})

				Toast.fire({
					icon: 'success',
					title: 'Checklist Updated successfully'
				})

				setTimeout(function() {
					$(".alert").alert('close');
				}, 2000);


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

	

	/* ############### FILE POND ##################### */


</script>
<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkSvueCGWz_a316NvJf7oDC6VD-MGwkOs&libraries=places&callback=initAutocomplete"
	async defer></script>
@endpush

@endsection