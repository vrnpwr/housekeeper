@extends('layouts.cleaner')

@section('content')


@push('styles')

<style type="text/css">
	.add-property {
		float: right;
	}

	.mdtp__wrapper {
		bottom: 120px !important;
	}

	.form-heading {
		font-size: 1.5em;
		margin-bottom: 25px;
	}

	.profile-img {
		height: 200px;
		margin-top: 25px;
		margin-left: 35px;
	}

	.show-password-block {
		margin-top: 35px;
	}
</style>


@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">
					<h3><i class="fas fa-home mr-3"></i>Profile Setting</h3>
				</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Profile Setting </li>
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
						<h5 class="font-weight-bold form-heading">Personal Info</h5>
						<div class="row">
							<div class="col-8">
								<div class="form-group">
									<label>First Name <span class="required">*</span></label>
									<input type="text" class="form-control name" value="{{ $user->name }}" id="first-name"
										name="first-name">
								</div>
								<div class="form-group">
									<label>Last Name</label>
									<input type="text" class="form-control last-name" value="{{ $user->last_name }}" id="last-name"
										name="last-name">
								</div>


							</div>

							<div class="col-4">
								@if($user->image)
								<?php $filepondSetting = 'none'; ?>
								<div id="img-block">
									<img src="{{ url('images/'.$user->image) }}" class="profile-img">
									<input type="hidden" value="{{ $user->image }}" id="image_0">
									<button class="del-profile-img"><i class="fas fa-trash"></i></button>
								</div>
								@else
								<?php $filepondSetting = 'block'; ?>
								@endif
								@push('script')
								<script>

								</script>
								@endpush

								<div class="form-group mt-5" id="filepond-block" style="display: <?php echo $filepondSetting ?>">
									<input type="file" name="image">
									<input type="hidden" id="image_0">
								</div>
							</div>

						</div><!-- Row -->
						<div class="row">
							<div class="col-4">
								<div class="form-group">
									<label>Email <span class="required">*</span></label>
									<input type="email" value="{{ $user->email }}" class="form-control" id="email" name="email">
								</div>
							</div>

							<div class="col-4">
								<div class="form-group">
									<label>Phone No</label>
									<input type="text" class="form-control" value="{{ $user->phone }}" id="phone" name="phone">
								</div>
							</div>

							<div class="col-4">
								<div class="form-group">
									<label>Your Hourly Rate</label>
									<input type="text" class="form-control" value="" id="hourly_rate" name="hourly_rate">
								</div>
							</div>
						</div>
						{{-- About yourself --}}
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Enter About Yourself</label>
									<textarea name="about_yourself" class="about_yourself form-control" id="about_yourself"></textarea>
								</div>
							</div>
						</div>
						<!--  Language and time Block -->
						<h5 class="font-weight-bold form-heading">Language and Time Block</h5>

						<div class="row">
							<div class="col-4">
								<div class="form-group">
									<label>Choose a Language</label>
									<select class="form-control language" id="language" name="language">
										<?php if ($user->language == 'english'): ?>
										<option selected="" value="english">English</option>
										<?php else: ?>
										<option selected="" value="hindi">Hindi</option>
										<?php endif ?>
									</select>
								</div>
							</div>

							<div class="col-4">
								<div class="form-group">
									<label>Prefered Time Format</label>
									<select class="form-control time-format" id="time-format" name="time-format">
										<option value="24 hours">24 Hours</option>
										<option value="am-pm">AM-PM</option>
									</select>
								</div>
							</div>

							<div class="col-4">
								<div class="form-group">
									<label>First day of the week</label>
									<select class="form-control first-day" id="first-day" name="first-day">
										<option value="sunday">Sunday</option>
										<option value="monday">Monday</option>
									</select>
								</div>
							</div>
						</div>

						<!-- Change your Password -->
						<h5 class="font-weight-bold form-heading">Change Your Password</h5>

						<form method="POST" action="{{ route('change.password') }}">
							@csrf

							@foreach ($errors->all() as $error)
							<p class="text-danger">{{ $error }}</p>
							@endforeach
							<div class="row">
								<div class="col-3">
									<div class="form-group">
										<label for="password">Current Password</label>
										<input id="password" type="password" class="form-control" value="{{ $user->password }}"
											name="current_password" autocomplete="current-password">
									</div>
								</div>

								<div class="show-password-block">
									<input type="checkbox" class="" name="">
									<label>Change Password?</label>
								</div>



								<div class="col-3 pass" style="display: none;">
									<div class="form-group">
										<label for="password">New Password</label>
										<input id="new_password" type="password" class="form-control" name="new_password"
											autocomplete="current-password">
									</div>
								</div>

								<div class="col-3 pass" style="display: none;">
									<div class="form-group">
										<label for="password">New Confirm Password</label>
										<input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password"
											autocomplete="current-password">
									</div>
								</div>
								<div class="col-3 pass" style="display: none;">
									<div class="form-group mt-3">
										<button type="submit" class="btn btn-default">
											Update Password
										</button>
									</div>
								</div>


							</div>

						</form>


						<div class="col-12">
							<button class="btn btn-success" id="update-profile">Update</button>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- /.container-fluid -->
</section>
<!-- /. content -->
</div>
<!-- /. content-wrapper -->

@push('script')
<script>
	$('.show-password-block').on('click', function(event) {
		event.preventDefault();
		$(this).remove();
		$('.pass').show();
		/* Act on the event */
	});

	$('.del-profile-img').on('click',function(){
		$(this).parent().remove();
		/* Call To Ajax function to delete file from database and folder*/
		var image = '<?php echo $user->image ?>'
		deleteImg(image);

		/* Call To Ajax function to delete file from database and folder*/
		/*Delete Image Function*/

		function deleteImg(image){											
			var url='{{ url("cleaner/profile/deleteImage") }}';
			$.ajax({
				type: 'POST',
				url: url,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data:{image},
				success:function(data){
					/* Alert when Image is deleted */
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
						title: 'Image Deleted Successfully'
					})

					/* Alert when Image is deleted */

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
			})
		}
		/*Delete Image Function*/

		$('#filepond-block').show()
	})
</script>
<script>
	$(document).ready(function($) {
	//Initialize Select2 Elements
	$('.select2').select2();

	//Initialize Select2 Elements
	$('.select2bs4').select2({
		theme: 'bootstrap4'
	});


	/* Add Multiple Chek Items*/
	setInterval(function(){
		$(".remove-btn").on('click',function(){
			var current = $(this).parent().parent().remove();
			// console.log(current);
		});
	},1000);
	

	$('#update-profile').click(function(event) {
		event.preventDefault();
		var name = $('#first-name').val();
		var last_name = $('#last-name').val();
		var hourly_rate = $('#hourly_rate').val();
		var image = $('#image_0').val();
		var email = $('#email').val();
		var phone = $('#phone').val();
		var language = $('#language').val();
		var time_format = $('#time-format').val();
		var about_yourself = $('#about_yourself').val();
		var first_day = $('#first-day').val();
		var old_password = $('#old-password').val();
		var new_password = $('#new-password').val();
		var confirm_password = $('#confirm-password').val();
		/* Check User request to change the current password and check for old password match or not*/
		/* Check old password match or not */
		/* This Condition check new password match the confirm password*/
		if (old_password && new_password && confirm_password ) {
			var password = confirm_password;
			updateProfile(name, last_name,image, about_yourself, email, phone, language, time_format, first_day, new_password, confirm_password,password );			
		}else{
			var password;
			updateProfile(name, last_name,image, about_yourself, email, phone, language, time_format, first_day, new_password=null, confirm_password = null, password=null );			
		}
	});


	/* Insert Property Data*/
	function updateProfile(name, last_name,image,about_yourself, email, phone, language, time_format, first_day, password ){
		$.ajax({
			type: 'POST',
			// url: '{{ action('cleaner\ProfileController@store') }}',
			url: '{{ url("cleaner/profile") }}',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data:{name, last_name,image,about_yourself, email, phone, language, time_format, first_day, password},
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
				swal.fire({
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