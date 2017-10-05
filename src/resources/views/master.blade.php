<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    
	    <title>@stack('title')</title>
		
		<meta name="description" content="@stack('description')">
	
	    
	    @stack('rssfeed')

		<link rel="stylesheet" href="/lil-plp/iba-blog/css/style.css" type="text/css">
		
		<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700&amp;subset=latin-ext" rel="stylesheet">
		
		<script type="text/javascript" src="/lil-plp/iba-blog/js/main.js"></script>
		
	</head>
	
	<body>
	    @yield('body')
	</body>
</html>
