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
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="{{ URL::to('manage/page') }}">Pages</a></li>
			<li><a href="{{ URL::to('manage/account') }}">Users</a></li>
		</ul>
	</nav>
	
	<!-- Main content -->
	<section id="content">
		{{  $content }}
	</section>
</div>

{{  Asset::container('footer')->scripts(); }}
</body>
</html>