@extends('backend.layouts.app')

@section('title', 'Create-user')

@section('content')
<div class="app-page-title">
	<div class="page-title-wrapper">
		<div class="page-title-heading">
			<div class="page-title-icon">
				<i class="metismenu-icon icon-gradient bg-mean-fruit pe-7s-users"></i>
			</div>
			<div>Create User</div>
		</div>   
	</div>
</div>

<div class="pt-3">
	<a href="{{ route('admin.user.index')}}" class="btn btn-secondary"><i class="pe-7s-back"></i> Back </a>
</div>

<div class="content py-3">
	<div class="card m-auto">
		<div class="card-body">
			@error('Fail')
			    <div class="alert alert-danger alert-dismissible fade show" role="alert">
			    	{{ $message }}
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			@enderror
			<form method="POST" action="{{ route('admin.user.store')}}">
				@csrf
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" class="@error('name') is-invalid @enderror form-control" value="{{ old('name') }}">
					{{-- @error('name')
					    <div class="alert alert-danger">
					    	{{ $message }}
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					    </div>
					@enderror --}}
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" class="@error('email') is-invalid @enderror form-control" value="{{ old('email') }}">
					{{-- @error('email')
					    <div class="alert alert-danger">
					    	{{ $message }}
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					    </div>
					@enderror --}}
				</div>

				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" class="@error('password') is-invalid @enderror form-control">
					{{-- @error('password')
					    <div class="alert alert-danger">
					    	{{ $message }}
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					    </div>
					@enderror --}}
				</div>

				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="number" name="phone" class="@error('phone') is-invalid @enderror form-control" value="{{ old('phone') }}">
					{{-- @error('phone')
					    <div class="alert alert-danger">
					    	{{ $message }}
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					    </div>
					@enderror --}}
				</div>

				<div class="">
					<button type="submit" class="btn btn-primary mx-1">Confirm</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('scripts')
	{!! JsValidator::formRequest('App\Http\Requests\StoreUser') !!}
@endsection

