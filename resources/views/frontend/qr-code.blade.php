@extends('frontend.layouts.app')
@section('title', 'QR Code')
@section('content') 
        <section class="qr-code my-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">Scan to pay</div>
                    <div class="text-center">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(230)->generate($authUser->phone)) !!} ">
                    </div>
                    <div class="text-center">
                        <strong class="d-block">{{ $authUser->name }}</strong>
                        <span class="d-block">{{ $authUser->phone }}</span>
                    </div>
                </div>
            </div>
        </section>
@endsection
