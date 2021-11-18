@extends('backend.layouts.app')

@section('title', 'transaction')

@section('content')
<div class="app-page-title">
	<div class="page-title-wrapper">
		<div class="page-title-heading">
			<div class="page-title-icon">
				<i class="metismenu-icon icon-gradient bg-mean-fruit pe-7s-news-paper"></i>
			</div>
			<div>Transactions</div>
		</div>   
	</div>
</div>

<div class="content pt-3">
	<div class="card">
		<div class="card-body">
			<table id="transactions-table" class="table table-bordered">
				<thead>
					<tr class="bg-light">
						<th>Trx_Id</th>
						<th>Date</th>
						<th>User</th>
						<th>Amount (MMK)</th>
						<th>Type</th>
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
			var table = $('#transactions-table').DataTable({
						    processing: true,
					        serverSide: true,
					        ajax: '/admin/transactions/datatable/ssd',
					        columnDefs: [{
								defaultContent : "-",
								targets : "_all"
							}],
					        columns: [
					            { data: 'trx_id', name: 'trx_id' },
					            { data: 'created_at', name: 'created_at'},
					            { data: 'user_id', name: 'user_id', searchable: true },
					            { data: 'amount', name: 'amount', searchable: false},
					            { data: 'type', name: 'type', searchable: false, orderable: false },
					            { data: 'action', name: 'action', searchable: false, orderable: false },
					        ]
					    });
			setInterval(function() {
				table.ajax.reload()
			}, 30000);
		});
	</script>

@endsection


