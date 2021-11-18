@extends('frontend.layouts.app')
@section('title', 'Notifications')
@section('content') 

<section class="notifications mt-3 mb-4 pb-5">
    @if($notifications->count() <= 0)
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-info-circle"></i>
                No notification
            </div>
        </div>
    @endif
    <div class="infinite-scroll">
    @foreach($notifications as $notification)
    <a href="{{ route('notifications.show', $notification->id )}}">
        <div class="card my-2 @if(is_null($notification->read_at)) noti_unread @endif">
        <div class="d-flex justify-content-between">
            <div class="align-self-center">
                @if($notification->data['title'] == 'Password Changed!')
                    <i class="fas fa-shield-alt fa-3x px-2"></i>
                @else
                    <i class="fas fa-file-invoice-dollar fa-3x px-3"></i>
                @endif
                
            </div>
            <div class="card-body p-2">
                <h5>{{ strlen($notification->data['title']) > 30 ? substr($notification->data['title'], 0, 28).'...' : $notification->data['title'] }}</h5>
                <div>{!! strlen($notification->data['message']) > 100 ? substr($notification->data['message'], 0, 97).'...' : $notification->data['message'] !!}</div>
                <small class="text-muted">{{ $notification->created_at->diffForHumans()}}</small>
            </div>
        </div>
        </div>
    </a>
    @endforeach
    {{ $notifications->links() }}
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
</script>
@endsection
