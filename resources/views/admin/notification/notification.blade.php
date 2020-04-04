@extends('layouts.admin')

@section('content')


@push('styles')

<style type="text/css">
	.add-property{
		float: right;
	}

	.mdtp__wrapper {
		bottom: 120px!important;
	}

	.heading{
		font-size: 1.2em;
		margin-bottom: 25px;
	}
	.option{
		margin: 35px 7px;
		font-size: 18px; 
	}
	.custom-control.custom-checkbox{
		margin: 35px 7px;
		font-size: 18px;  
	}
	
</style>


@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark"><h3><i class="fas fa-cog mr-3"></i>Notification Setting</h3> </h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Notification Setting </li>
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
						<!--  Notification  Heading Area -->
						<form id="form" >
							
							<div class="row">
								<div class="col-4">

								</div>

								<div class="col-2">
									<div class="heading">Notification Center</div>

									<input type="checkbox" id="selectall_notification"/>
									<label>Select / Unselect All</label>
								</div>

								<div class="col-2">
									<div class="heading">E-mail</div>

									<input type="checkbox" id="selectall_email"/>
									<label>Select / Unselect All</label>
								</div>

								<div class="col-2">
									<div class="heading">Mobile</div>

									<input type="checkbox" id="selectall_mobile"/>
									<label>Select / Unselect All</label>
								</div>

								<div class="col-2">
									<div class="heading">SMS</div>

									<input type="checkbox" id="selectall_sms"/>
									<label>Select / Unselect All</label>
								</div>

							</div>
							<!-- ! row -->

							<!-- Notification Check box area -->
							
							<!-- Below code check the data in the notification variable if not available send in else condition and use options variable which is comming for Notification Controller. -->

							@if(!$notifications == null)

							@include('elements.notification_if')
							@else

							@include('elemets.notification_else')


							@endif

							<!-- Submit Button -->
							<div class="row">

								<div class="col-12">
									<button class="btn btn-info float-right mt-5" id="notification-btn">Update Notification Setting</button>									
								</div>

							</div>
						</form>

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


	// add multiple select / deselect functionality For Notification
	$("#selectall_notification").click(function () {
		$('.case_notification').attr('checked', this.checked);
	});

	$(".case_notification").click(function(){

		if($(".case_notification").length == $(".case_notification:checked").length) {
			$("#selectall_notification").attr("checked", "checked");
		} else {
			$("#selectall_notification").removeAttr("checked");
		}
	});
	// add multiple select / deselect functionality For Email

	$("#selectall_email").click(function () {
		$('.case_email').attr('checked', this.checked);
	});

	$(".case_email").click(function(){

		if($(".case_email").length == $(".case_email:checked").length) {
			$("#selectall_email").attr("checked", "checked");
		} else {
			$("#selectall_email").removeAttr("checked");
		}
	});

	// add multiple select / deselect functionality For Mobile

	$("#selectall_mobile").click(function () {
		$('.case_mobile').attr('checked', this.checked);
	});

	$(".case_mobile").click(function(){

		if($(".case_mobile").length == $(".case_mobile:checked").length) {
			$("#selectall_mobile").attr("checked", "checked");
		} else {
			$("#selectall_mobile").removeAttr("checked");
		}
	});

	// add multiple select / deselect functionality For SMS


	$("#selectall_sms").click(function () {
		$('.case_sms').attr('checked', this.checked);
	});

	$(".case_sms").click(function(){

		if($(".case_sms").length == $(".case_sms:checked").length) {
			$("#selectall_sms").attr("checked", "checked");
		} else {
			$("#selectall_sms").removeAttr("checked");
		}
	});

	/* SUBMIT/UPDATE NOTIFICATION FORM WITH AJAX */

	$("#notification-btn").on('click', function(event) {
		event.preventDefault();
		var notification = $("input[name='notification\\[\\]']:checked").map(function(){return $(this).val();}).get();
		var email = $("input[name='email\\[\\]']:checked").map(function(){
			return $(this).val();
		}).get();
		var mobile = $("input[name='mobile\\[\\]']:checked").map(function(){return $(this).val();}).get();
		var sms = $("input[name='sms\\[\\]']:checked").map(function(){return $(this).val();}).get();
		// console.log(notification);
		// var data = $("#form").serialize();
		updateNotification();
		/* Act on the event */
	});

	/*Update Notification Function*/
	function updateNotification(){

		$.ajax({
			type: 'POST',
			url: '{{ action('NotificationController@store') }}',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data: $('form').serialize(),
			success:function(data){				
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Your work has been saved',
					showConfirmButton: false,
					timer: 1500
				})
				.then(() => {
					// window.location.reload();
      					// $('#form').trigger("reset");
      					// $(".print-error-msg").css('display','none');
      				})				

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

	/* SUBMIT/UPDATE NOTIFICATION FORM WITH AJAX */

</script>
@endpush


@endsection
