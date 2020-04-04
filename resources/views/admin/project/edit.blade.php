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
				<h1 class="m-0 text-dark"> Edit Project</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Edit Project </li>
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
										<label for="title">Select Property <span class="required">*</span></label>
										<input type="hidden" value="{{ $project->id }}" id="post_id">
										<input type="hidden" value="{{ $user->id }}" id="user_id" >
										<select class="form-control " name="property_id" id="property_id">
											<option selected="" value="{{ $selectedProperty->id }}">{{ $selectedProperty->property_name }}</option>
											@foreach($properties as $key=>$property)
											<option value="{{ $property->id }}">{{ $property->property_name }}</option>
											@endforeach

										</select>

									</div>
								</div>
							</div>
							<div class="row">
								<!-- Date and time range -->
								<div class="col-6">
									
									<div class="form-group">
										<label>Date and time range:</label>

										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="far fa-clock"></i></span>
											</div>
											<input type="text" value="{{ $project->dates_timmings }}" class="form-control float-right dates_timmings" id="reservationtime">
										</div>
										<!-- /.input group -->
									</div>
									<!-- /.form group -->
								</div>
								<div class="col-3">
									<div class="form-group">

										<label for="cleaning_price">Cleaning Price <span class="required">*</span></label>
										<input type="text" name="cleaning_price" value="{{ $project->cleaning_price }}" class="form-control" id="cleaning_price" placeholder="Cleaning Price">
									</div>
								</div>


								<div class="col-3">
									<div class="form-group mt-4 ml-3" id="property_default_checklist_box">
										<input type="checkbox" name="property_default_checklist" value="" class="" id="property_default_checklist"  value="1">
										<label for="end_date">Use property default checklist</label>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="start_time">This project will pay: <span class="required">*</span></label><br>
										
										<input type="radio" class="rate" name="rate" value="flat_rate"@if($project->rate == "flat_rate") checked @endif> A flat rate <br>
										
										
										<input type="radio" class="rate" name="rate" value="hourly_rate" @if($project->rate == "hourly_rate") checked @endif > Hourly rate <br>			
										
										<input type="radio" class="rate" name="rate" value="property_rate" @if($project->rate == "property_rate") checked @endif > The property rate for the cleaner <br>
										
										
									</div>
								</div>
							</div>

							<div class="row  checklist_div">
								<div class="col-md-12">
									<div class="form-group">
										<label for="title">Select Checklist <span class="required">*</span></label>
										<select class="form-control" id="checklist_id" name="checklist_id">
											@if($selectedChecklist)
											<option selected="" value="{{ $selectedChecklist->id }}">{{ $selectedChecklist->title }}</option>
											@endif

											@foreach($checklists as $key=>$checklist)
											<option value="{{ $checklist->id }}">{{ $checklist->title }}</option>>
											@endforeach

										</select>

									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="additional_notes">Additional Notes</label>
										<textarea name="additional_notes" id="additional_notes" class="form-control" placeholder="Additional Notes visible to cleaner(optional)">{{ $project->additional_notes }}</textarea>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">


										<label for="host_notes">Host Notes (Not visible to cleaners)</label>
										<textarea name="host_notes" id="host_notes" class="form-control" placeholder="Additional Notes visible to cleaner(optional)">{{ $project->host_notes }}</textarea>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<!-- Publish Project -->
										<input type="checkbox" id="publish_project" name="publish_project" value="0" @if($project->publish_project == 1) checked @endif />&nbsp;&nbsp;
										<label for="publish_project">Publish Project</label>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<!--  Restrict Cleaner -->
										<input type="checkbox" id="restrict_cleaner" name="restrict_cleaner"  value="0"
										@if($project->restrict_cleaner == 1) checked @endif>&nbsp;&nbsp;
										<label for="restrict_cleaner">Restrict to Specific Cleaners</label>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-12">
									<button class="btn btn-success float-right" id="project-btn">Update</button>
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
		/*Custom code*/
		$('#property_default_checklist').click(function(event) {
			$('.checklist_div').toggle();
			/* Act on the event */
		});
		/*publish Project Logic*/
		$('#publish_project').click(function(event) {
			if ($(this).val() == 0 ) {
				$(this).attr('value',1);
			}
		});

		/* Restrict Cleaner Logic*/
		$('#restrict_cleaner').click(function(event) {
			if ($(this).val() == 0 ) {
				$(this).attr('value',1);
			}
		});
		
		$('#reservationtime').daterangepicker({
			timePicker: true,
			timePickerIncrement: 30,
			locale: {
				format: 'MM/DD/YYYY hh:mm A'
			}
		})
	//Initialize Select2 Elements
	$('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
    	theme: 'bootstrap4'
    });

    setInterval(function(){
    	$(".remove-btn").on('click',function(){
    		var current = $(this).parent().parent().remove();
    		// console.log(current);
    	});
    },1000);


    $('#project-btn').click(function(event) {
    	event.preventDefault();
      // sweet alert    
      var post_id = $('#post_id').val();
      var user_id = $('#user_id') .val();
      var property_id = $('#property_id').val();
      var dates_timmings = $('.dates_timmings').val();
      var rate = $('.rate').val();
      var cleaning_price = $('#cleaning_price').val();
      var additional_notes = $('#additional_notes').val();
      var host_notes = $('#host_notes').val();
      var checklist_id = $('#checklist_id').val();
      var publish_project = $('#publish_project').val();
      var restrict_cleaner = $('#restrict_cleaner').val();
      updateProject(post_id,user_id, property_id, dates_timmings, rate, cleaning_price, additional_notes, host_notes, checklist_id, publish_project, restrict_cleaner);
  });
    /* Insert Property Data*/
    function updateProject(post_id, user_id,property_id, dates_timmings, rate, cleaning_price, additional_notes, host_notes, checklist_id, publish_project, restrict_cleaner){
    	var url='{{ url("project/update") }}';
    	$.ajax({
    		type: 'POST',
    		url: url,
    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    		data:{post_id, user_id, property_id, dates_timmings, rate, cleaning_price, additional_notes, host_notes, checklist_id, publish_project, restrict_cleaner},
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

	/* Form Validation */

	/* ############### FILE POND ##################### */
	// Register file pond

	FilePond.registerPlugin(
		FilePondPluginFileValidateSize,
		FilePondPluginImageExifOrientation,
		FilePondPluginImageCrop,
		FilePondPluginImageResize,
		FilePondPluginImagePreview,
		FilePondPluginImageTransform,
		FilePondPluginFileValidateType
		);

// Set default FilePond options
FilePond.setOptions({
// maximum allowed file size
maxFileSize: '221MB',
acceptedFileTypes: ['image/*'],
// labelIdle: 'Upload videos or photos (Max 221MB)',
maxFiles: 50,
instantUpload: true,
server:{
	process:'{{ url("/filepond/uploadImage?_method=get") }}',
	revert: '/filepond/deleteImage?_method=DELETE&_token=<?php echo csrf_token(); ?>'
}

});
// Turn a file input into a file pond
var pond = FilePond.create(document.querySelector('input[name="image"]'));
var pond1 = FilePond.create(document.querySelector('input[name="image1"]'));

function getImageSrc(selector){
	var collectHtml="";
	var files = selector.getFiles();
	for(i in files){
		var item = files[i];    
		collectHtml +=item.serverId;
	}
  // console.log(collectHtml);
  return collectHtml;
}

$('#form').change(function(e){
	e.preventDefault();
	$('#image').val(getImageSrc(pond));
	$('#image1').val(getImageSrc(pond1));

});

/* ############### FILE POND ##################### */


</script>

@endpush

@endsection
