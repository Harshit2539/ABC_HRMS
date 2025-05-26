<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="SoengSouy Admin Template">
	<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
	<meta name="author" content="SoengSouy Admin Template">
	<meta name="robots" content="noindex, nofollow">
	<title>Dashboard - HRMS</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/favicon.png') }}">
	<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('assets/css/line-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
	<script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
</head>

<body>
	<style>
		.invalid-feedback {
			font-size: 14px;
		}
	</style>

	@auth
		

	@include('layouts.sidebar');

	<!-- Main Wrapper -->
	<div class="main-wrapper">
		<!-- Header -->
		<div class="header">

			<!-- Logo -->
			<div class="header-left">
				<a href="{{ route('home') }}" class="logo"> <img src="{{ URL::to('assets/img/abchrms.png') }}" width="40" height="40" alt=""> </a>
			</div>
			<!-- /Logo -->
			<a id="toggle_btn" href="javascript:void(0);">
				<span class="bar-icon"><span></span><span></span><span></span></span>
			</a>
			<!-- Header Title -->
			<div class="page-title-box">
				<h3>{{ Auth::user()->name }}</h3>
			</div>
			<!-- /Header Title -->
			<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>


			<!-- Header Menu -->
			<ul class="nav user-menu">

				<li>
					<span class="dropdown show">
						<a style="background-color:white !important; color:black; margin-top:.6em;" class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Switch Language
						</a>
						<span class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="top:60px !important; left:12px;">
							@foreach(config('localization.locales') as $locale)
							<a href="{{ route('localization', $locale) }}" class="dropdown-item {{ app()->getLocale() == $locale ? 'bg-dark text-white' : '' }}">
								{{ $locale }}
								@if(app()->getLocale() == $locale)
								<span class="float-right">
									<i class="fa fa-check" aria-hidden="true"></i>
								</span>
								@endif
							</a>
							@endforeach
						</span>
					</span>
				</li>
				<!-- /Message Notifications -->
				<li class="nav-item dropdown has-arrow main-drop">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img">

							<img src="assets/img/redianlogo.jpeg" alt="">

							<span class="status online"></span></span>
						<span>{{ Auth::user()->name }}</span>
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="{{ route('user.information') }}">Profile</a>
						<a class="dropdown-item" href="{{ route('company/settings/page') }}">Settings</a>
						<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
					</div>
				</li>
			</ul>
			<!-- /Header Menu -->



			<!-- Mobile Menu -->
			<div class="dropdown mobile-user-menu">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<i class="fa fa-ellipsis-v"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="profile.html">My Profile</a>
					<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
				</div>
			</div>
			<!-- /Mobile Menu -->

		</div>
		<!-- /Header -->
		
		<!-- Page Wrapper -->
		@yield('content')
		<!-- /Page Wrapper -->
	</div>
	<!-- /Main Wrapper -->

	@endauth


	<!-- jQuery -->
	<script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/chart.js') }}"></script>
	<script src="{{ URL::to('assets/js/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/app.js') }}"></script>
	<script src="{{ URL::to('assets/js/axios.js') }}"></script>




	@yield('script')
</body>

</html>