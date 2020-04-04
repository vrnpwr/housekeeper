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
				<h1 class="m-0 text-dark">Schedule</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Property </li>
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
						<h3 class="card-title">Schedule List</h3>
						<div class="add-property">
							<a href="#" class="btn btn-info">Add Special Schedule</a>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<!-- THE CALENDAR -->
						<div class="response"></div>
						<div id="calendar"></div>
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

<!-- ##################Modal################# -->
<div id="fullCalModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>

			</div>
			<div id="modalBody" class="modal-body"></div>


		</div>
	</div>
</div>    


{{-- 
	@if($data)
	<div class="row">
		<div class="col-md-12">

			<div class="row">
				<div class="col-md-7">
					<span class="start_date_popup"><?php echo date('D, M d, Y',strtotime($data['start_date'])); ?></span>
				</div>
				<div class="col-md-5">
					<a title="Edit Project" class="edit_project" href="{{ url('project/edit/.$data->id') }}"><i class="fa fa-edit"></i></a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<span><b><?php echo $project_data['start_time']; ?></b></span><br>
					<span>Guest Leaves</span>
				</div>
				<div class="col-md-6">
					<span><b><?php echo $project_data['finish_time']; ?></b></span><br>
					<span>Finish by</span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ url('project/edit/.$data->id') }}"><span class="property_name_popup"><?php echo $project_data['property_name']; ?></span></a>
				</div>
			</div>
		</div>
	</div>
	@endif
	--}}
	<!-- ##################Modal################# -->


	@push('script')
	<script type="text/javascript">


		$(document).ready(function($) {
			var SITEURL = "{{url('/')}}";
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,basicDay'
				},
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: SITEURL+'/showcalendar',
      eventClick:  function(event, jsEvent, view) {

      	var id=event.id;

      	$.ajax({
      		url: SITEURL+"/viewcalendar",
      		type: 'post',
      		dataType: 'html',
      		data: {id: id},
      		success: function(response) {
      			// var data = JSON.stringify(response);
      			var data=$("#modalBody").html(response);
      			$('#fullCalModal').modal();
      		}
      	});


      },
      eventRender: function(event, element)
      { 

      	element.find('.fc-title').prepend("<div class='fc-desc'>"+event.description+"</div>"); 
      }
  });

		});



	            // Delete Function 
	            setInterval(function(){

	            	$(".delete").on("click",function(e){
	            		e.preventDefault();    
	            		swal({
	            			title: "Are you sure to Delete?",
	            			text: "Press Ok to Delete your data!",
	            			icon: "warning",
	            			buttons: true,
	            			dangerMode: true,
	            		})
	            		.then((willDelete) => {
	            			if (willDelete) {
	            				var id = $(this).data("id");
	            				console.log("post ID is "+ id);
	            				var token = $("meta[name='csrf-token']").attr("content");
	            				$.ajax(
	            				{
	            					url: "property/"+id,
	            					type: 'DELETE',
	            					data: {
	            						"id": id,
	            						"_token": token,
	            					},
	            					success:function(data){
	            						$('div.flash-message').html(data);
	            						setTimeout(function(){
	            							window.location.reload();
	            						},1000)
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
	            				});
	            			} else {
	            				swal("Data Not saved!");
	            			}
	            		});
	            	});

	            },1000);
	        </script>
	        @endpush

	        @endsection
