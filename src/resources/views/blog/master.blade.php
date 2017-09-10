<!DOCTYPE html>
<html lang="en">
	<head>
	   <meta charset="utf-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    
	    <title>
	    	@stack('title')
		    | LIL</title>
		
		<meta name="description" content="@stack('description')
			">
	
	    
	    @stack('rssfeed')
	    
		<link rel="stylesheet" href="/css/pure.css" type="text/css">
		<link rel="stylesheet" href="/css/backgrounds.css" type="text/css">
		
		
		<link rel="stylesheet" href="/css/selectize.css" type="text/css">
		<link rel="stylesheet" href="/css/style.css" type="text/css">
		
		<link rel="stylesheet" href="/css/journal.css" type="text/css">
		<link rel="stylesheet" href="/css/ideas.css" type="text/css">
		
		<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700&amp;subset=latin-ext" rel="stylesheet">
		<link rel="stylesheet" href="/css/fonts.css" type="text/css">
		
		
	    <script type="text/javascript" src="/js/template.js"></script>
	    <link  href="/fotorama/fotorama.css" rel="stylesheet">
		<script src="/fotorama/fotorama.js"></script>
		<script src="/js/selectize.js"></script>

	</head>
	
	<body class="template-@yield('cssclass')
		">
			@yield('body')
			@include('modules.master.footer')
		<script src="/lil-plp/iba-blog/js/index.js"></script>
	</body>
</html>
