@extends('frontend.layouts.app')
@section('title', 'Scan and Pay')
@section('content')
<section class="scan-and-pay-confirm mt-4 mb-5 pb-4">
    <div class="card">
        <div class="card-body p-3">
            @error('wallet_amount')
            <p class="text-danger ">{{$message}}</p>
            @enderror
            @error('Fail')
            <p class="alert alert-danger px-2 py-1 border-0">{{$message}}</p>
            @enderror
            <form action="{{ url('scan-and-pay/complete') }}" method="POST" id="passwordCheckForm">
                @csrf
                <input type="hidden" name="hash_val" value="{{$hash_val}}">
                <input type="hidden" name="to_phone" value="{{$to_user->phone}}">
                <input type="hidden" name="transfer_amount" value="{{$amount}}">
                <input type="hidden" name="description" value="{{$description}}">
                <div class="form-group">
                    <label class="my-0 font-weight-bold">From</label>
                    <p class="text-muted">{{$from_user->name}}</p>
                </div>
                 <div class="form-group">
                    <label class="my-0 font-weight-bold">To</label>
                    <p class="text-muted">{{$to_user->phone}} (<span> {{$to_user->name}} </span>)</p>
                </div>
                 <div class="form-group">
                    <label class="my-0 font-weight-bold">Transfer Amount (MMK)</label>
                    <p class="text-muted text-uppercase">{{number_format($amount,2)}}</p>
                </div>
                 <div class="form-group">
                    <label class="my-0 font-weight-bold">Description</label>
                    <p class="text-muted">{{$description ?? '-'}}</p>
                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-theme btn-block send_btn">Send</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.send_btn').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                    title: 'Fill your password',
                    icon: 'info',
                    html:
                    '<input type="password" name="password" class="form-control text-center" id="check_password" autocomplete="off" autofocus />',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true,
                    confirmButtonColor: '#FF756B',
                    cancelButtonColor: '#aaa'
                }).then(result => {
                    if (result.isConfirmed) {
                        let password = $('#check_password').val(); 
                        $.ajax({
                            url: '/transfer/password-check/'+password,
                            type: 'POST',
                            success: function(res){
                                if (res.status == 'success') {
                                    $('#passwordCheckForm').submit();     
                                }else{
                                     Swal.fire({
                                      icon: 'error',
                                      title: 'Oops...',
                                      text: res.message
                                    })
                                }
                            }
                        })
                    }
                })
            
        })
    })
</script>
@endsection
