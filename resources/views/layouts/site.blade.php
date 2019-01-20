<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!-- Import Materialize CSS -->
		<link rel="stylesheet" type="text/css" href="{{ asset('lib/materialize/css/materialize.min.css') }}">
		<!-- Custom CSS style - Overwriting some Materialize CSS -->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
		<!-- Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">

		<title>{{ config('app.name', 'Laravel') }}</title>

	</head>
	<body>
		<header>
			@include('layouts._site._nav')
		</header>

		<main>
			<!-- Define that this page template is parent inherit from other child page -->
			@yield('content')
		</main>

		@include('layouts._site._footer')

		<!-- Scripts -->
		<script src="{{ asset('lib/jquery/jquery-3.3.1.js') }}"></script>
		<script src="{{ asset('lib/materialize/js/materialize.min.js') }}"></script>
		<script src="{{ asset('js/init.js') }}"></script>

		@if(Session::has('message'))
			<script type="text/javascript">
				Materialize.toast("{{ Session::get('message')['msg'] }}", 4000, "{{ Session::get('message')['class'] }}");
			</script>
		@endif()
	</body>
</html>