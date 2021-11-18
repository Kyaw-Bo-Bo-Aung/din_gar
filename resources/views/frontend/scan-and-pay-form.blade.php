@extends('frontend.layouts.app')
@section('title', 'Scan and Pay')
@section('content')
<section class="transfer mt-4 mb-5 pb-4">
    <div class="card">
        @error('Fail')
        <p class="alert alert-danger">{{$message}}</p>
        @enderror
        <div class="card-body p-3">
            <form action="{{ url('scan-and-pay/confirm') }}" method="GET" autocomplete="off" id="transferContinue_form">
            {{-- @csrf --}}
            <input type="hidden" name="hash_val" id="hash_val">
            <input type="hidden" name="to_phone" value="{{$to_user->phone}}">
            <div class="form-group">
                <label class="my-0">From</label>
                <div class="text-muted">{{$from_user->phone}} ({{$from_user->name}}) </div>
            </div>
             <div class="form-group">
                <label class="my-0">To </label> 
                <div class="text-muted">{{$to_user->phone}} ({{$to_user->name}}) </div>
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
