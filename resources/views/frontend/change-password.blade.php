@extends('frontend.layouts.app')
@section('title', 'Change Password')
@section('content')

<section class="change-password my-4">
	<div class="card">
		<div class="card-body">
			<div class="text-center">
				<img src="{{ asset('img/change-password.png')}}" class="img-fluid" width="200">
			</div>
			<form method="POST" action="{{ route('change-password.update') }}">
				@csrf
				@method('PUT')
				<div class="form-group">
					<label for="old_password">Old Password</label>
					<input type="password" id="old_password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" value="{{ old('old_password') }}">
					@error('old_password')
					    <p class="text-danger">{{ $message }}</p>
					@enderror
				</div>
				<div class="form-group">
					<label for="new_password">New Password</label>
					<input type="password" id="new_password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" value="{{ old('new_password') }}">
					@error('new_password')
					    <p class="text-danger">{{ $message }}</p>
					@enderror
				</div>
				<div class="form-group mt-4">
					<button class="btn btn-theme btn-block">Change Password</button>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection
