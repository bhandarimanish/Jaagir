<!DOCTYPE html>
<html>
<head>
	<title></title>
	    <script defer src="{{ asset('js/app.js') }}"  ></script>

	@include('../partials.head')
</head>
<body>
	@include('../partials.nav')
@yield('content')

	@include('../partials.footer')
 
</body>
</html>