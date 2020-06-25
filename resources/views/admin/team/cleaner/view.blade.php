@extends('layouts.admin')

@section('content')


@push('styles')

<style type="text/css">

</style>


@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 mt-5">
        <h1 class="m-0 text-dark"><i class="fas fa-home mr-3"></i>My Cleaners</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">My Cleaner </li>
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
            <div class="add-property">
              <a href="{{ url('/invite/create') }}" class="btn btn-primary float-right">Invite cleaner</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Cleaner Name</th>
                  <th>Properties</th>
                  <th>Email / Phone</th>
                  <th>Ratings</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cleaners as $key=>$cleaner)
                <tr>
                  <td>{{ $cleaner->cleaner_name }}</td>
                  @php
                  $property_ids = json_decode($invites[$key]->property_ids);
                  @endphp
                  <td>
                    @foreach($properties as $key=>$property)
                    @if(in_array($property->id , $property_ids))<p>{{ $property->property_name }}</p>@endif
                    @endforeach
                  </td>
                  @if($cleaner->invitation_type == 'email')
                  <td>{{ $cleaner->details }}</td>
                  @endif
                  <td>
                    @for($i = 0; $i < 5; $i++) <i class="far fa-star text-center" style="font-size: 2em;"></i>
                      @endfor
                  </td>
                  <td>
                    <button class="btn btn-default"><span class="mr-3"><i class="far fa-comment-alt"></i></span>Send
                      Message</button>
                    <a href="#" class="btn btn-default delete mr-invite3" data-id="{{$cleaner->id}}">
                      <span class="mr-3"><i class="far fa-trash-alt"></i></span>Remove
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
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
<script>
  // Delete Function 
	setInterval(function(){
// Remove Invitation
$(".delete").on("click",function(e){
	e.preventDefault();    
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, Remove it!'
	}).then((result) => {
		if (result.value) {
			var id = $(this).data("id");
			console.log("post ID is "+ id);
			var token = $("meta[name='csrf-token']").attr("content");
			$.ajax(
			{
				url: "invite/"+id,
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
						// window.location.reload();
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
// Resent Code
$(".resend").on("click" , function(e){
	e.preventDefault();    
	Swal.fire({
		title: 'Are you sure?',
		text: "Resent Invitation to Cleaner!",
		icon: 'info',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, Resent!'
	}).then((result) => {
		if (result.value) {
			var id = $(this).data("id");
			console.log("Resent Id is "+ id);
			var token = $("meta[name='csrf-token']").attr("content");
			$.ajax(
			{
				url: "invite/resent/"+id,
				type: 'get',
				data: {
					"id": id,
					"_token": token,
				},
				success:function(data){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Invitation Successfully resent to Cleaner',
						showConfirmButton: false,
						timer: 1500
					})
					.then(() => {
						$('div.flash-message').html(data);
						// window.location.reload();
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