<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
	<link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/css/bootstrap-theme.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
	@yield('styles')
</head>
<body>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			@include('layouts.header')
		</div>
	</nav>

	<div class="container-fluid">
		@yield('content')
	</div>

	<script src="{{asset('admin/js/jquery-1.11.2.min.js')}}"></script>
	<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('admin/js/app.js')}}"></script>
	@yield('scripts')

</body>
</html>
