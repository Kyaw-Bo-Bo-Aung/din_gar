@extends('frontend.layouts.app_plain')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-5">
            <div class="card auth-form">
                <div class="card-body">
                    <h3 class="text-center">Login</h3>
                    <p class="text-center text-muted mb-4"><em>Yahoo... Welcome!</em></p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="phone">{{ __('Phone') }}</label>

                            <div>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div>
                                <button type="submit" class="btn btn-theme btn-block mt-4 mb-2">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-between mx-1">
                                <a href="{{ route('register') }}" class="text-sm-center">
                                Register Here!</a>
                                @if (Route::has('password.request'))
                                    {{-- <a href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a> --}}
                                @endif
                            </div>
                        </div>            
                    </form>
                    <div class="text-center text-muted">
                        <div><small>Developed By <a href="https://kyawboboaung.me/" target="_blank">Kyaw Bo Bo Aung</a></small></div>
                        <div><small>Credit @ <a href="https://www.youtube.com/channel/UCZm9ZXFcdrD8NRBY6HslZPw" target="_blank">Fullstack DEV</a></small></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
