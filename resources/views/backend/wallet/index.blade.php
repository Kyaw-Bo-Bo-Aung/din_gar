@extends('backend.layouts.app')

@section('title', 'wallet')

@section('content')
<div class="app-page-title">
	<div class="page-title-wrapper">
		<div class="page-title-heading">
			<div class="page-title-icon">
				<i class="metismenu-icon icon-gradient bg-mean-fruit pe-7s-wallet"></i>
			</div>
			<div>Wallets</div>
		</div>   
	</div>
</div>

<div class="pt-3">
	<a href="{{ url('admin/wallet/add') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Wallet</a>
	<a href="{{ url('admin/wallet/reduce') }}" class="btn btn-danger"><i class="fas fa-minus-circle"></i> Reduce Wallet</a>
</div>

<div class="content pt-3">
	<div class="card">
		<div class="card-body">
			<table id="wallet-table" class="table table-bordered">
				<thead>
					<tr class="bg-light">
						<th>Account Number</th>
						<th>Account User</th>
						<th>Amount (MMK)</th>						
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
			var table = $('#wallet-table').DataTable({
						    processing: true,
					        serverSide: true,
					        ajax: '/admin/wallet/datatable/ssd',
					        columns: [
					            { data: 'account_number', name: 'account_number' },
					            { data: 'account_user', name: 'account_user' },
					            { data: 'amount', name: 'amount' },
					        ],
					        order: [
					        	[ 0, "desc" ]
					        ]
					    });

			setInterval(function() {
				table.ajax.reload()
			}, 30000);

		});
	</script>

@endsection


