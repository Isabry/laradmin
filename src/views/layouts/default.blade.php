<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{!!Config::get('laradmin.project.name')!!}</title>
	<link rel="icon" type="image/png" href="{{asset('favicon.png')}}" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap-theme.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	@yield('styles')
</head>
<body>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			@include('laradmin::layouts.header')
		</div>
	</nav>

	<div class="container">
		@include('laradmin::layouts.notifications')
		@yield('content')
	</div>
	</div>

    <footer class="pagefooter">
      <div class="container">
        <p class="text-muted">Ismail SABRY - Copyright &copy; 2014</p>
      </div>
    </footer>

	<script src="{{asset('assets/js/jquery-1.11.2.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/app.js')}}"></script>
	@yield('scripts')

</body>
</html>
