<!DOCTYPE html>
<html lang="en">
<head>
	<title>Xinergi Management System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('logo/logo.png')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginxms/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginxms/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginxms/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginxms/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginxms/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginxms/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginxms/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginxms/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginxms/css/util.css">
	<link rel="stylesheet" type="text/css" href="loginxms/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
          @csrf
					<span class="login100-form-title p-b-26">
						Welcome to XMS
					</span>
					<span class="login100-form-title p-b-48">
						{{-- <i class="zmdi zmdi-font"></i> --}}
            {{-- Xinergi Management System --}}
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: XMS21JK">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								{{ __('Login') }}
							</button>
						</div>
					</div>
					<div class="text-center p-t-70">
						<a class="txt2" href="/">
							Back to home
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="loginxms/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="loginxms/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="loginxms/vendor/bootstrap/js/popper.js"></script>
	<script src="loginxms/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="loginxms/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="loginxms/vendor/daterangepicker/moment.min.js"></script>
	<script src="loginxms/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="loginxms/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="loginxms/js/main.js"></script>

</body>
</html>
