<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css">
		<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/css/datepicker.css"}}>
		<script src="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<link rel="stylesheet" href={{URL::asset('../css/style.css');}}>
		<script src={{URL::asset('../js/script.js');}}></script>
		<script src={{URL::asset('../js/fb.js');}}></script>
		<script src={{URL::asset('../js/jquery.dataTables.min.js');}}></script>
		<script src={{URL::asset('../js/DT_bootstrap.js');}}></script>
	</head>
	<body>
		<div class="container-narrow">
			@yield('content')
		</div>
	</body>
</html>