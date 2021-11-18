<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documentation</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-light bg-light">
	<div class="container">
	  <a class="navbar-brand" href="#">Din Gar</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav ml-auto ">
	      <li class="nav-item">
	        <a class="nav-link" href="#">Home</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">How to use</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="{{url('/login')}}">Log in</a>
	      </li>
	    </ul>
	  </div>
	 </div>
	</nav>

	<div class="container">
		<div class="row py-4">
			<div class="col-md-6 pb-3 align-self-center">
				<div>
					<h4 style="font-size: 3rem;">Your future payment is here!</h4>
					<hr style="border: 1px solid #FF756B;" class="ml-1 w-75 my-5">
					<p class="small text-muted">
						Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim.
					</p>
					<div class="mt-5">
						<a href="{{url('/login')}}" class="btn btn-theme"><span class="h6">Log in</span></a>
					</div>
				</div>
			</div>
			<div class="col-md-6 align-self-center">
				<div>
					<img src="{{asset('img/payment.png')}}" alt="image-illustration" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
	<section class="container">
		<h3 class="text-center">How to use</h3>
		<hr style="border: 1px solid #FF756B;" class="w-25 my-4">
		
		<div id="carouselExampleControls" class="carousel slide my-3" data-ride="carousel">
		  <div class="carousel-inner">
		    <div class="carousel-item active">
		      <img src="{{asset('img/payment.png')}}" class="img-fluid d-block m-auto" width="300px" alt="...">
		      <p class='text-center'>Please Log in to your account. (If you don't have account, plase register.)</p>
		    </div>
		    <div class="carousel-item">
		      <img src="{{asset('img/payment.png')}}" class="img-fluid d-block m-auto" width="300px" alt="...">
		      <p class='text-center'>In this demo app, you have 10,000 MMK in your wallet for testing.</p>
		    </div>
		    <div class="carousel-item">
		      <img src="{{asset('img/payment.png')}}" class="img-fluid d-block m-auto" width="300px" alt="...">
		      <p class='text-center'>Consectetur adipisicing elit, sed do eiusmod
		      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		      quis nostrud exercitatio</p>
		    </div>
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>

	</section>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>