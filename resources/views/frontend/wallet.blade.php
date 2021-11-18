@extends('frontend.layouts.app')
@section('title', 'Wallet')
@section('content') 
        <section class="wallet my-4">
            <div class="card">
                <div class="card-body">
                    {{-- <img src="{{ asset('img/bank3d.png')}}" class="img-fluid"> --}}
                    <div id="wallet-amount">
                        <span class="text-uppercase"><small>Amount</small></span>
                        <span class="lead d-inline-flex pr-1" id="real_time_wallet"></span><small>MMK</small>
                    </div>
                    <div id="wallet-number" class="my-3">
                        <span class="text-uppercase"><small>Account Number</small></span>
                        <span class="lead">{{ $user->wallet ? $user->wallet->account_number : '-' }}</span>
                    </div>
                    <div id="wallet-user" class="pt-3">
                        <span class="text-uppercase"><small>Account Name</small></span>
                        <span class="lead">{{ $user->name }}</span>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var walletAmount = function (){
                                $.ajax({
                                    url: '/real-time-wallet',
                                    type: 'GET',
                                    success: function(res){
                                        $('#real_time_wallet').html(`${res}`);
                                    }
                                    });
                            };
        walletAmount();
        setInterval(walletAmount, 10000);
    })
</script>
@endsection
