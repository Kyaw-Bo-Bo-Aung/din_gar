@extends('frontend.layouts.app')
@section('title', 'Notification')
@section('content') 

<section class="notification mt-3 mb-4 pb-5">
    <div class="card">
        <div class="card-body text-center">
            <img src="{{asset('img/notification.png')}}" class="img-fluid" width="200">
            <h5>{{$notification->data['title']}}</h5>
            <p class="text-muted"> {!! $notification->data['message'] !!} </p>
            <small class="d-block">{{ $notification->created_at->format('h:i:s a') }}</small>
            <small class="d-block mb-3">{{ $notification->created_at->format('d-M-Y') }}</small>
            <a href="{{ $notification->data['web_link'] }}" class="btn btn-theme btn-sm">Continue</a>
        </div>
    </div>
</section>
@endsection