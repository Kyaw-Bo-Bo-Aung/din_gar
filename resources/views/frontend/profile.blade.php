@extends('frontend.layouts.app')
@section('title', 'Profile')
@section('content')

<section class="account">
	<div class="profile-photo text-center py-4">
		<img src="https://ui-avatars.com/api/?name={{$user->name}}&background=FF756B&color=fff" class="rounded-circle">
	</div>
	<div class="profile-detail">
		<div class="card">
			<div class="card-body p-0">
				<div class="d-flex justify-content-between py-3 px-3">
					<span>Name :</span>
					<span>{{ $user->name }}</span>
				</div>
				<hr class="my-0">
				<div class="d-flex justify-content-between py-3 px-3">
					<span>Email :</span>
					<span>{{ $user->email }}</span>
				</div>
				<hr class="my-0">
				<div class="d-flex justify-content-between py-3 px-3">
					<span>Phone :</span>
					<span>{{ $user->phone }}</span>
				</div>
			</div>
		</div>

		<div class="card my-3">
			<div class="card-body p-0">
				<a href="{{ route('change-password') }}" class="d-flex justify-content-between change-pwd-btn py-3 px-3">
					<span>Change password</span>
					<span><i class="fas fa-angle-right"></i></span>
				</a>
				<hr class="my-0">
				<div class="d-flex justify-content-between logout-btn py-3 px-3">
					<a href="{{ route('logout') }}">
                        Logout
                    </a>
                    <span><i class="fas fa-angle-right"></i></span>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
					{{-- <span>Logout</span>
					<span><i class="fas fa-angle-right"></i></span> --}}
				</div>
			</div>
		</div>
	</div>	
</section>
@endsection
@section('scripts')
<script>
		$(document).ready(function() {
			$(document).on('click', '.logout-btn', function(e){
				e.preventDefault();
				Swal.fire({
					title: 'Logout?',
					// text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#FF756B',
					cancelButtonColor: '#aaa',
					confirmButtonText: 'Logout',
					reverseButtons: true
					})
				.then((result) => {
					if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();

						//ajax call 
						// $.ajax({
						// 	url: "{{ route('logout') }}",
						// 	type: "POST",
						// 	success: function(res) {
						// 	}
						// })
						//complete message
						// Swal.fire(
						//   'Deleted!',
						//   'Your file has been deleted.',
						//   'success'
						// )
					}
				})
			})
		});
	</script>
@endsection