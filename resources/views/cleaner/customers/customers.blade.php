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
          <h3>Current Customers</h3>
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Current Customers </li>
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
                  <th>Client Name</th>
                  <th>Properties</th>
                  <th>Email / Phone</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($propertydetails as $key=>$property)
                <tr>
                  <td>{{ $clients[$key]->name }}</td>
                  <td>{{ $property['property_name'] }}</td>
                  <td>{{ $clients[$key]->email }}</td>
                  <td>
                    <button class="btn btn-default">View</button>
                    <button class="btn btn-default delete" data-id="{{ $invites[$key]->id }}">Remove</button>
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
<!-- /. content -->
</div>
<!-- /. content-wrapper -->

@push('script')
<script>
  setTimeout(function() {
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
			var token = $("meta[name='csrf-token']").attr("content");
			$.ajax(
			{
				url: "invites/"+id,
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