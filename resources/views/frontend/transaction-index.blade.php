@extends('frontend.layouts.app')
@section('title', 'Transactions')
@section('content') 

<section class="Transaction mt-3 mb-4 pb-5">
    <div class="row">
        <div class="col-6">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text p-1">Date</label>
              </div>
              <input type="text" name="date" class="form-control date" value="{{ request()->date ?? request()->date }}">
            </div>
        </div>
        
         <div class="col-6">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text p-1">Type</label>
              </div>
              <select class="custom-select" id="type_filter">
                <option value="">All</option>
                <option value="1" @if(request()->type == 1) selected @endif>Income</option>
                <option value="2" @if(request()->type == 2) selected @endif>Expense</option>
              </select>
            </div>
        </div>
    </div>
    <div class="infinite-scroll">
    @foreach($transactions as $transaction)
    <a href="{{ route('transactions.show', $transaction->trx_id )}}">
        <div class="card my-2">
        <div class="d-flex justify-content-between">
            <div class="card-body p-2">
                <h6><b>Trx_id:</b> {{$transaction->trx_id}} </h6>     
                    <div class="text-muted">
                        @if($transaction->type == 1) 
                        <b>From</b> 
                        @elseif($transaction->type == 2) 
                        <b>To</b> 
                        @endif
                        {{$transaction->source? $transaction->source->name : '-'}}
                    </div>
                    <div class="text-muted">
                        Amount: 
                        @if($transaction->type == 2)
                            <span class="text-danger"> - {{ number_format($transaction->amount, 2) }} <small>MMK</small></span>
                        @elseif($transaction->type == 1)
                            <span class="text-success"> + {{ number_format($transaction->amount, 2) }} <small>MMK</small></span>
                        @endif 
                    </div>
                    <div class="text-muted">
                        Date: {{ $transaction->created_at->format('M d Y (D)') }}
                    </div>
            </div>
            <div class="align-self-center">
                <i class="fas fa-chevron-right pr-2"></i>
            </div>
        </div>
        </div>
    </a>
    @endforeach
    {{ $transactions->links() }}
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('frontend/js/jscroll.js')}}"></script>
<script>
        $('ul.pagination').hide();
            // $(function() {
                $('.infinite-scroll').jscroll({
                    autoTrigger: true,
                    loadingHtml: '<img class="center-block" src="{{asset('img/loading.gif')}}" alt="Loading..." />',
                    padding: 0,
                    nextSelector: '.pagination li.active + li a',
                    contentSelector: 'div.infinite-scroll',
                    callback: function() {
                        $('ul.pagination').remove();
                    }
                });
            // });
        $('#type_filter').on('change',function() {
            var type = $('#type_filter').val();
            var date = $('.date').val();
            history.pushState(null, '', `?type=${type}&date=${date}`);
            window.location.reload();
        })
        // date picker
        $('.date').daterangepicker({
            "singleDatePicker": true,
            "autoApply": true,
            "locale": {
                "format": "DD-MM-YYYY"
            }
        })
        $('.date').on('apply.daterangepicker', function() {
            var type = $('#type_filter').val();
            var date = $('.date').val();
            history.pushState(null, '', `?type=${type}&date=${date}`);
            window.location.reload();
        });
</script>
@endsection
