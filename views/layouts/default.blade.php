<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>{{  $meta_title }} | Layla</title>
	{{  Asset::container('header')->styles(); }}
	{{  Asset::container('header')->scripts(); }}
</head>
<body>

<!-- Main holder -->
<div id="holder"  class="clearfix">
	<!-- Navigation, Only used for develop atm -->
	<nav>
		{{ Menu::container('main')->render() }}
	</nav>
	
	<!-- Main content -->
	<section id="content">
		{{  $content }}
	</section>
</div>

{{  Asset::container('footer')->scripts(); }}
</body>
</html>