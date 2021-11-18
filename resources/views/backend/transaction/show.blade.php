@extends('backend.layouts.app')

@section('title', 'transaction-detail')

@section('content')
<div class="app-page-title">
	<div class="page-title-wrapper">
		<div class="page-title-heading">
			<div class="page-title-icon">
				<i class="metismenu-icon icon-gradient bg-mean-fruit pe-7s-news-paper"></i>
			</div>
			<div>Transaction Detail</div>
		</div>   
	</div>
</div>
<div class="pt-3">
	<a href="{{ route('admin.transactions.index')}}" class="btn btn-secondary"><i class="pe-7s-back"></i> Back </a>
</div>
<div class="content py-3">
	<div class="card">
		<div class="card-body">
			<div class="px-5">
				<h5>Trx_no: {{$transaction->trx_id}}</h5>
				<div class="text-muted">Date : {{ $transaction->created_at->format('d-M-Y') }}</div>
				<div class="text-muted">Time : {{ $transaction->created_at->format('H:m:s') }}</div>
			</div>
			<hr>
			@if($transaction->type == 1)
			{{-- <div class="d-flex justify-content-between px-5"> --}}
				<div class="px-5">
					<h6>From </h6>
					<div>
						<div><b>name</b>: {{$transaction->source ? $transaction->source->name : 'Admin'}}</div>
						<div><b>phone</b> : {{$transaction->source ? $transaction->source->phone : '-'}}</div>
						<div><b>email</b> : {{$transaction->source ? $transaction->source->email : '-'}}</div>
					</div>
				</div>
				<hr>
				<div class="px-5">
					<h6>To </h6>
					<div>
						<div><b>name:</b> {{$transaction->user ? $transaction->user->name : '-'}}</div>
						<div><b>phone:</b> {{$transaction->user ? $transaction->user->phone : '-'}}</div>
						<div><b>email:</b> {{$transaction->user ? $transaction->user->email : '-'}}</div>
					</div>
				</div>
			{{-- </div> --}}
			@elseif($transaction->type == 2)
			{{-- <div class="d-flex justify-content-between px-5"> --}}
				<div class="px-5">
					<h6>From </h6>
					<div>
						<div><b>name:</b> {{$transaction->user ? $transaction->user->name : '-'}}</div>
						<div><b>phone:</b> {{$transaction->user ? $transaction->user->phone : '-'}}</div>
						<div><b>email:</b> {{$transaction->user ? $transaction->user->email : '-'}}</div>
					</div>
				</div>
				<hr>
				<div class="px-5">
					<h6>To </h6>
					<div>
						<div><b>name</b>: {{$transaction->source ? $transaction->source->name : 'Admin'}}</div>
						<div><b>phone</b> : {{$transaction->source ? $transaction->source->phone : '-'}}</div>
						<div><b>email</b> : {{$transaction->source ? $transaction->source->email : '-'}}</div>
					</div>
				</div>
			{{-- </div> --}}
			@endif
			<hr>
			<div class="d-flex justify-content-between px-5"><b>Amount :</b> {{$transaction->amount}} MMK</div>
			<hr>
			<div class="d-flex justify-content-between px-5">
				<b>Type :</b> 
				@if($transaction->type == 1)
					<span class="badge badge-success rounded-pill align-self-center p-2">Income</span>
				@else
					<span class="badge badge-danger badge-rounded-pill align-self-center p-2">Expense</span>
				@endif
			</div>
			<hr>
			<div class="d-flex justify-content-between px-5"><b>Description :</b> {{$transaction->description ?? '-'}}</div>
			<hr>
			<div class="px-5">
				<small class="text-muted d-block">DinGar&copy;Application</small>
				<small class="text-muted d-block"><em>dingar.kyawboboaung.me</em></small>
			</div>
			<div class="mt-4 px-5 float-right">
				<a href="" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
				<a href="" class="btn btn-info"><i class="fas fa-download"></i> PDF</a>
			</div>
		</div>
	</div>
</div>

@endsection
