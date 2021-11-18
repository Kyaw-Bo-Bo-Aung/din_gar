@extends('frontend.layouts.app')
@section('title', 'Transaction Detail')
@section('content') 
<section class="transaction-show mt-3 mb-5 pb-5">
    <div class="card">
        <div class="card-body px-3">
            <div class="text-center">
                <img src="{{ asset('img/checked.png')}}" class="img-fluid pb-3" width="50">
            </div>
            <div class="text-center">
                @if($transaction->type == 1) <h3 class="text-success">+ {{ number_format($transaction->amount, 2) }} <small>MMK</small></h3>
                @elseif($transaction->type == 2) <h3 class="text-danger">- {{ number_format($transaction->amount, 2) }} <small>MMK</small></h3>
                @endif
            </div>
            @if(session('success'))
            <div class="text-center alert alert-success fade show" role="alert">{{ session('success') }}</div>
            @endif
            <div class="d-flex justify-content-between mt-4">
                <div>Transaction id:</div>
                <div> {{ $transaction->trx_id }}</div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <div>Reference No:</div>
                <div> {{ $transaction->ref_no }}</div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <div>Amount:</div>
                <div> {{ $transaction->amount }}</div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <div>Type:</div>
                <div> 
                    @if($transaction->type == 1) <span class="badge badge-success badge-rounded-pill p-2">Income</span>
                    @elseif($transaction->type == 2) <span class="badge badge-danger badge-rounded-pill p-2">Expense</span>
                    @endif
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <div>
                    @if($transaction->type == 1) From :
                    @elseif($transaction->type == 2) To :
                    @endif
                </div>
                <div> {{ $transaction->source? $transaction->source->name : '-' }}</div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <div>Date:</div>
                <div> {{ $transaction->created_at->format('M - d - Y') }}</div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <div>Time :</div>
                <div> {{ $transaction->created_at->format('h : i : s A') }}</div>
            </div>
            <hr>
            <div>
                <div>Description :</div>
                <div class="text-justify py-1"> {{ $transaction->description ?? '-' }}</div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $('.back-btn').on('click', function(e) {
                e.preventDefault();
                window.location.href = '/transactions';
            })
</script>
@endsection
