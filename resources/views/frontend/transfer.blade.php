@extends('frontend.layouts.app')
@section('title', 'Transfer')
@section('content')
<section class="transfer mt-4 mb-5 pb-4">
    <div class="card">
        @error('Fail')
        <p class="alert alert-danger">{{$message}}</p>
        @enderror
        <div class="card-body p-3">
            <form action="{{ route('transfer-confirm') }}" method="GET" autocomplete="off" id="transferContinue_form">
            {{-- @csrf --}}
            <input type="hidden" name="hash_val" id="hash_val">
            <div class="form-group">
                <label class="my-0">From</label>
                <p class="text-muted text-uppercase">{{$user->name}}</p>
            </div>
             <div class="form-group">
                <label class="my-0">To </label> 
                <span id="checkSuccess" class="text-success"></span>
                <span id="checkFail" class="text-danger"></span>
                <div class="input-group">
                    <input type="number" id="to_phone" name="to_phone" class="form-control @error('to_phone') is-invalid @enderror" value="{{ old('to_phone') }}">
                    <div class="input-group-append">
                        <span class="input-group-text btn check-btn" id="basic-addon2">
                            <i class="fas fa-check-circle"></i>
                        </span>
                    </div>
                </div>
                 @error('to_phone')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                
            </div>
             <div class="form-group">
                <label class="my-0">Transfer Amount</label>
                <input type="number" name="transfer_amount" class="form-control @error('transfer_amount') is-invalid @enderror" value="{{ old('transfer_amount') }}">
                @error('transfer_amount')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                @error('wallet_amount')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
             <div class="form-group">
                <label class="my-0">Description</label>
                <textarea class="form-control" rows="3" name="description">{{ old('description') }}</textarea>
            </div>
            <div class="form-group continue_btn">
                <button class="btn btn-theme btn-block">Continue</button>
            </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.check-btn').on('click', function() {
            var phone = $('#to_phone').val();
            if (!phone) {
                return $('#checkFail').html('( Please fill account number )');
            }
            $.ajax({
                url: '/transfer/check-user/' + phone,
                type: 'POST',
                success: function(res) {
                    if (res.status == 'success') {
                        $('#checkSuccess').html('( '+res.data.name+' )');
                        $('#checkFail').html('');
                    }else {
                        $('#checkFail').html('( '+res.message+' )');
                        $('#checkSuccess').html('');
                    }
                }
            })
        })

        $('.continue_btn').on('click', function(e) {
            e.preventDefault();
            let phone = $('input[name="to_phone"]').val();
            let amount = $('input[name="transfer_amount"]').val();
            let desc = $('textarea[name="description"]').val();
            $.ajax({
                url: `/transaction/hash?description=${desc}&phone=${phone}&amount=${amount}`,
                type: 'GET',
                success: function(res) {
                    if (res.status == 'success') {
                        let hash_val = $('#hash_val').val(res.data);
                        $('#transferContinue_form').submit();
                    }
                }
            })
        })
    })
</script>

@endsection
