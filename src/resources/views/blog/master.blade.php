<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>
			{{ config('iba-blog.name')}}
		</title>
		
<!-- 		Adding RSS FEEDs -->
		
		<script type="text/javascript" src="/js/template.js"></script>
		<link rel="stylesheet" href="/lil-plp/iba-blog/css/style.css" type="text/css">
		


	</head>
	
	<body>
		<script>
			Window.Config = <?php echo json_encode(config('iba-blog')); ?>;
		</script>
			
		@yield('body')
		
		<script src="/lil-plp/iba-blog/js/index.js"></script>
		
	</body>
</html>
