@extends('layouts.admin')

@section('content')


@push('styles')

<style type="text/css">
	.add-property{
		float: right;
	}
</style>


@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Project</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Project </li>
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
						<h3 class="card-title">Project List</h3>
						<div class="add-property">
							<a href="{{ url('/project/create') }}" class="btn btn-primary">Add Project</a>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div class="card card-primary card-outline card-outline-tabs">
							<div class="card-header p-0 border-bottom-0">
								<ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="pending-tab" data-toggle="pill" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="accepted-tab" data-toggle="pill" href="#accepted" role="tab" aria-controls="accepted" aria-selected="false">Accepted</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="cancel-tab" data-toggle="pill" href="#cancel" role="tab" aria-controls="cancel" aria-selected="false">Cancelled</a>
									</li>


								</ul>
<<<<<<< Updated upstream
							</div>
							<div class="card-body">
								<div class="tab-content" id="custom-tabs-three-tabContent">


									<div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

										<!-- /.card-body -->

										@if(!count($pendings) >= 1)
										@foreach($pendings as $key=>$value)
										@foreach($value as $key=>$pending)

										<div class="card-footer mt-2 mb-2">
											<!-- dates and timming Details -->
											<h5 class="lead">{{ $pending->dates_timmings }}</h5>
											<!-- property Name -->
											<h6 class="font-weight-bold">{{ $pending->property_name }}</h6>
											<!-- Publish Status -->
											@if($pending->publish_project == 1)
											<h6 class="font-weight-bold">published</h6>
											@else
											<h6 class="font-weight-bold">Pending</h6>											
											@endif
											<!-- Delete -->
											<a href="#" class="btn btn-default float-right ml-2 delete" data-id="{{ $pending->id }}"><i class="fas fa-trash"></i></a>
											<!-- Edit -->
											<a href="{{ url('/project/'.$pending->id.'/edit') }}" class="btn btn-default float-right"><i class="fas fa-edit"></i></a>
										</div>

										@endforeach
										@endforeach

										@else
										@foreach($pendings as $key=>$pending)
										<div class="card-footer mt-2 mb-2">
											<!-- dates and timming Details -->
											<h5 class="lead">{{ $pending[0]->dates_timmings }}</h5>
											<!-- property Name -->
											<h6 class="font-weight-bold">{{ $pending[0]->property_name }}</h6>
											<!-- Publish Status -->
											@if($pending[0]->publish_project == 1)
											<h6 class="font-weight-bold">published</h6>
											@else
											<h6 class="font-weight-bold">Pending</h6>											
											@endif
											<!-- Delete -->
											<a href="#" class="btn btn-default float-right ml-2 delete" data-id="{{ $pending[0]->id }}"><i class="fas fa-trash"></i></a>
											<!-- Edit -->
											<a href="{{ url('/project/'.$pending[0]->id.'/edit') }}" class="btn btn-default float-right"><i class="fas fa-edit"></i></a>
										</div>
										@endforeach

										
										@endif

										<!-- /.card-footer-->
										<!-- /.card -->


=======
								<div class="resp-tabs-container hor_1">
									<div>
										<p>
											<!--vertical Tabs-->
											<div id="ChildVerticalTab_1">
												<ul class="resp-tabs-list ver_1">
													@if(isset($invites) && !is_null($invites))
													@foreach ($invites as $key=>$invite)
													<li><span class="pending_status">{{ ($invite->invite_status) ? 'Accepted' :'Pending'  }}
														</span><span class="time_status"> {{ $invite->check_in }}</span>
														<span class="code_tag"> {{ $invite->invitation_code }} <span class="pending_city">
																{{ $invite->country }}</span></span>
														{{-- <p class="unassigned_class"> Unassigned</p> --}}
													</li>
													@endforeach
													@endif
												</ul>
												<div class="resp-tabs-container ver_1">
													@if(isset($invites) && !is_null($invites))
													@foreach ($invites as $key=>$invite)
													<div class="view_pending_accepted">
														<div class="schedule_projects_info">
															<h6 class="project_codes">Project #{{ $invite->invitation_code }}</h6>
															<h4 class="city_view_name">{{ ucfirst($invite->property_name) }}</h4>
															<h6 class="project_codes">Cleaner: Unassigned</h6>
															<h6 class="available_cleaner">Available to these cleaners</h6>
															<div class="start_end_time">
																<div class="row">
																	<div class="col-lg-6">
																		<div class="start_time_section">
																			<h6 class="project_codes"> Start Time</h6>
																			<h4 class="start_time">{{ $invite->checkin }}</h4>
																			<p class="start_time_date"> Jul 18 (Sat)</p>
																		</div>
																	</div>
																	<div class="col-lg-6">
																		<div class="start_time_section">
																			<h6 class="project_codes"> End Time</h6>
																			<h4 class="start_time">{{ $invite->checkout }}</h4>
																			<p class="start_time_date"> Jul 18 (Sat)</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="unpublish_area">
																<div class="d-flex text-center">
																	<div
																		style="border-radius: 50%; width: 15px; height: 15px; background-color: rgb(255, 59, 48);">
																	</div>
																	<span class=""> Unpublished</span>
																</div>
															</div>
															<div class="list_created">
																<p class="last_updated"><i class="fa fa-refresh" aria-hidden="true"></i> Last update:
																	<span> Project Created</span></p>
																<p class="last_updated"> <i class="fa fa-map-marker" aria-hidden="true"></i>
																	{{ $invite->country .' , '. $invite->state .' , '. $invite->city}}</p>
																<p class="last_updated"> <i class="fa fa-list" aria-hidden="true"></i> Checklist:<span>
																		New Checklist</span></p>
																<p class="last_updated"> <i class="fa fa-sticky-note" aria-hidden="true"></i> Private
																	notes:<span> Reservation URL </span> Guest phone ends: 5097</p>
															</div>

															{{-- Quotes Display--}}
															<div class="list_created">
																@if(isset($invite->quotes_array) && $invite->quote_status)
																<label class="m-2">
																	Quotes Recieved
																</label>
																@foreach ($invite->quotes_array as $key=>$quote)
																<div class="last_updated"><i class="fa fa-refresh" aria-hidden="true"></i>
																	<span>Name : </span>
																	{{ $invite->cleaner_information[$key]['name'] }},
																	<div class="d-inline text-center">
																		<span>Offer Price : </span>{{ $quote->price }}
																	</div>
																	, <span>message : </span> {{ Str::limit($quote->message, 30) }}
																	<a href="{{ url('/chatbox') }}">
																		<button class="btn btn-info float-right btn-sm">
																			<i class="far fa-envelope"></i>
																		</button>
																	</a>
																</div>
																@endforeach
																@else
																<label class="m-2">
																	No Quotes Recieved yet...
																</label>
																@endif
															</div>
														</div>

													</div>
													@endforeach
													@endif
												</div>
											</div>
										</p>
										<p style="color:#fff;">Tab 2 Container</p>
>>>>>>> Stashed changes
									</div>

									<div class="tab-pane fade" id="accepted" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
										<div class="row">
											<h2>Accepted</h2>
										</div>
									</div>

									<div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
										<div class="row">											
											<h2>Cancelled</h2>
										</div>
									</div>
								</div>
							</div>
							<!-- /.card -->

							<!-- Error Messages -->
							<div class="alert alert-danger print-error-msg" style="display:none">
								<ul></ul>
							</div>

						</div>
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
	            					url: "project/"+id,
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
	            							window.location.reload();
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
