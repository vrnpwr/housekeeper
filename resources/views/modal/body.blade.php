
<div class="row">
	<div class="col-md-12">

		<div class="row">
			<div class="col-md-7">
				<span class="start_date_popup"><?php echo date('D, M d, Y',strtotime($data['project_data']->start_date ) ); ?></span>
			</div>
			<div class="col-md-5">
				<a title="Edit Project" class="edit_project" 
				href="{{ url('project/'.$data['project_data']->id.'/editproject' ) }}">
				<i class="fa fa-edit"></i></a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span><b><?php echo $data['project_data']->start_time ?></b></span><br>
				<span>Guest Leaves</span>
			</div>
			<div class="col-md-6">
				<span><b><?php echo $data['project_data']->end_time ?></b></span><br>
				<span>Finish by</span>
			</div>
		</div>
		<div class="row">
			
			<div class="col-md-12">
				<a href="{{ url('project/editproject/'.$data['project_data']->property_id) }}"><span class="property_name_popup">
					{{ $data['project_data']->property_name }}</span></a>
				</div>
			</div>
		</div>
	</div>