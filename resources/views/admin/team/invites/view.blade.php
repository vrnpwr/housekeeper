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
				<h1 class="m-0 text-dark"><i class="fas fa-home mr-3"></i>Pending Invitations</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Invites </li>
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
									<th>Name</th>
									<th>Role</th>
									<th>Email</th>
									<th>Invitation Code</th>
									<th>Phone No</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Varun</td>
									<td>fhdj</td>
									<td>fsdf</td>
									<td>dsfds</td>
									<td>fdsf</td>
									<td>dsfsd</td>
								</tr>
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




@endsection