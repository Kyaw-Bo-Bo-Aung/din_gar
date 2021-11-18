@extends('frontend.layouts.app')
@section('title', 'Din Gar')
@section('content')
<section class="home">
    <div class="row">
        <div class="col-12">
            <div class="profile-photo text-center pt-4 pb-2">
                <img src="https://ui-avatars.com/api/?name={{$user->name}}&background=FF756B&color=fff" class="rounded-circle" width="50" height="50">
            </div>
            <div class="profile-name text-center">
                <span class="lead d-block">{{$user->name}}</span>
                <span class="font-weight-bold text-muted">{{ $user->wallet ? number_format($user->wallet->amount,2) : '0' }}</span><span class="text-muted"> MMK</span>
            </div>
        </div>
        <div class="col-6 my-3">
           <a href="{{url('scan-and-pay')}}" class="change-pwd-btn">
                <div class="card">
                    <div class="card-body px-2 py-3">
                        <img src="{{asset('img/qr-code-scan.png')}}" class="img-fluid d-inline-flex mr-1" width="25" height="25">
                        <span>Scan & Pay</span>
                    </div>
                </div>
           </a>
        </div>
        <div class="col-6 my-3">
            <a href="{{url('qr-code')}}" class="change-pwd-btn">
                <div class="card">
                    <div class="card-body px-2 py-3">
                        <img src="{{asset('img/qr-code.png')}}" class="img-fluid d-inline-flex mr-1" width="25" height="25">
                        <span>Recieve QR</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="card my-2">
        <div class="card-body p-0">
            <a href="{{route('transfer')}}" class="d-flex justify-content-between change-pwd-btn py-3 px-3">
                <span>
                    <img src="{{asset('img/money-transfer.png')}}" class="img-fluid d-inline-flex mr-1" width="25" height="25">
                    Transfer
                </span>
                <span><i class="fas fa-angle-right"></i></span>
            </a>
            <hr class="my-0">
            <a href="{{ route('wallet') }}" class="d-flex justify-content-between change-pwd-btn py-3 px-3">
                <span>
                    <img src="{{asset('img/wallet.png')}}" class="img-fluid d-inline-flex mr-1" width="25" height="25">
                    Wallet
                </span>
                <span><i class="fas fa-angle-right"></i></span>
            </a>
            <hr class="my-0">
            <a href="{{ route('transactions.index') }}" class="d-flex justify-content-between change-pwd-btn py-3 px-3">
                <span>
                    <img src="{{asset('img/transaction.png')}}" class="img-fluid d-inline-flex mr-1" width="25" height="25">
                    Transaction
                </span>
                <span><i class="fas fa-angle-right"></i></span>
            </a>            
        </div>
    </div>
</section>
@endsection
