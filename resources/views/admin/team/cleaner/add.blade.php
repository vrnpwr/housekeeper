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

	.headings {
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
	.custom-label {
		margin-left: 70px;
	}
</style>


@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark"> Invite a new Cleaner</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Add Project </li>
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
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label>Property</label>
									<div class="select2-purple">
										<select id="property_id" class="select2" name="property_id[]" multiple="multiple"
											data-placeholder="Select Property" data-dropdown-css-class="select2-purple" style="width: 100%;">
											@foreach($properties as $key=>$property)
											<option value="{{ $property->id }}">{{ $property->property_name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<!-- /.form-group -->
							</div>


							@foreach ($properties as$key=>$property)

							<div class="font-weight-bold col-4 pl-5 mt-5">
								{{ $property->property_name}}
							</div>
							<div class="col-2 mt-5">
								<label class="switch">
									<input name="project_setting" type="checkbox" value="1" class="default">
									<span class="slider round"></span>
								</label>
							</div>

							@endforeach

						</div>
						<button class="btn btn-success">Next</button>
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
	});
</script>
@endpush



@endsection