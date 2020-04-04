@extends('layouts.admin')

@section('content')


@push('styles')

<style type="text/css">
	.headings{
		font-size: 1.3em;
		margin: 20px;
	}

	/* ############The switch - the box around the slider############ */
	.switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 34px;
		margin-left: 20px;
		/*float:right;*/
	}

	/* Hide default HTML checkbox */
	.switch input {display:none;}

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

	input.default:checked + .slider {
		background-color: #444;
	}
	input.primary:checked + .slider {
		background-color: #2196F3;
	}
	input.success:checked + .slider {
		background-color: #8bc34a;
	}
	input.info:checked + .slider {
		background-color: #3de0f5;
	}
	input.warning:checked + .slider {
		background-color: #FFC107;
	}
	input.danger:checked + .slider {
		background-color: #f44336;
	}

	input:focus + .slider {
		box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
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
	.custom-label{
		margin-left: 70px;
	}
</style>


@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark"><i class="fas fa-home mr-3"></i>Project Setting</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Project Setting </li>
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
					<form>			
						<!-- Block -->
						<!-- if User settings is saved already then if condition work otherwise else -->
						@if(!$projectSettings == null)
						@foreach($projectSettings as $key=>$value)
						<div class="card-header">
							<div class="row">
								<div class="col-12">
									<div class="headings">{{ $value->title }}</div>
								</div>
								<div class="col-3">
									<label class="switch">
										<!-- Hidden Files -->
										<input type="hidden" name="project_setting[{{$key}}][title]" value="{{ $value->title }}">
										<input type="hidden" name="project_setting[{{$key}}][description]" value="{{$value->description}}">
										<input type="hidden" name="project_setting[{{$key}}][key]" value="{{$value->key}}">
										<!-- Hidden Files -->
										<?php $keyName = $value->key ?>
										@if(isset($value->$keyName) && $value->$keyName == 1 )
										<input  name="project_setting[{{$key}}][{{$keyName}}]" type="checkbox" checked="" 
										value="1" class="default">
										@else
										<input  name="project_setting[{{$key}}][{{$keyName}}]" type="checkbox" value="1" class="default">
										@endif


										<span class="slider round"></span>
									</label>
								</div>
								<div class="col-9 descriptions">
									{{ $value->description }}
								</div>
							</div>						

						</div> 
						@endforeach
						@else
						
						@foreach($options as $key=>$value)
						<div class="card-header">
							<div class="row">
								<div class="col-12">

									<div class="headings">{{ $value['title'] }}</div>
								</div>
								<div class="col-3">
									<label class="switch">
										<input type="hidden" name="project_setting[{{$key}}][title]" value="{{$value['title']}}">
										<input type="hidden" name="project_setting[{{$key}}][description]" value="{{$value['description']}}">
										<input type="hidden" name="project_setting[{{$key}}][key]" value="{{$value['key']}}">
										<input  name="project_setting[{{$key}}][{{$value['key']}}]" type="checkbox" value="1" class="default">
										<span class="slider round"></span>
									</label>
								</div>
								<div class="col-9 descriptions">
									{{ $value['description'] }}
								</div>
							</div>						

						</div> 
						@endforeach
						@endif
						<!-- Block -->


					</form>
					<!-- /.card-header -->
					<div class="card-body">

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
		$('form').change(function(event) {
			/* Act on the event */
			projectSettings();
		});

		function projectSettings(){
			$.ajax({
				type: 'POST',
				url: '{{ action('ProjectSettingController@store') }}',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: $('form').serialize(),
				success:function(data){
					/* if Data save successfully save notification will appears*/
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
						title: 'Settings Saved'
					})
					/* if Data save successfully save notification will appears*/

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

	</script>
	@endpush

	@endsection
