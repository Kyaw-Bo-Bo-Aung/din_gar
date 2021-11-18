@extends('backend.layouts.app')

@section('title', 'admin-user')

@section('content')
<div class="app-page-title">
	<div class="page-title-wrapper">
		<div class="page-title-heading">
			<div class="page-title-icon">
				<i class="metismenu-icon icon-gradient bg-mean-fruit pe-7s-users"></i>
			</div>
			<div>Admin Users</div>
		</div>   
	</div>
</div>

<div class="pt-3">
	<a href="{{ route('admin.admin-user.create')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Admin User</a>
</div>

<div class="content pt-3">
	<div class="card">
		<div class="card-body">
			<table id="admin-users-table" class="table table-bordered">
				<thead>
					<tr class="bg-light">
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Ip</th>
						<th>User Agent</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

@endsection

@section('scripts')

	<script>
		$(document).ready(function() {
			var table = $('#admin-users-table').DataTable({
						    processing: true,
					        serverSide: true,
					        ajax: '/admin/admin-user/datatable/ssd',
					        columns: [
					            { data: 'name', name: 'name' },
					            { data: 'email', name: 'email' },
					            { data: 'phone', name: 'phone' },
					            { data: 'ip', name: 'ip' },
					            { data: 'user_agent', name: 'user_agent', sarchable: false, sortable: false},
					            { data: 'action', name: 'action', sarchable: false, sortable: false }
					        ]
					    });

			setInterval(function() {
				table.ajax.reload()
			}, 30000);

			$(document).on('click', '.delete_btn', function(e){
				e.preventDefault();
				let id = $(this).data('id');
				Swal.fire({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Delete'
					})
				.then((result) => {
					if (result.isConfirmed) {
						//ajax call 
						$.ajax({
							url: "admin-user/"+id,
							type: "DELETE",
							success: function() {
								table.ajax.reload();
							}
						})
						//complete message
						Swal.fire(
						  'Deleted!',
						  'Your file has been deleted.',
						  'success'
						)
					}
				})
			})

		});
	</script>

@endsection


