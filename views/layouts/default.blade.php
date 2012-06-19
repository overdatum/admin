<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>{{  $meta_title }} | Layla</title>
	{{  Asset::container('header')->styles(); }}
	{{  Asset::container('header')->scripts(); }}
</head>
<body>

<div id="menu">
	{{ Menu::handler('main')->prefix(substr(prefix('admin'), 0, -1))->render() }}
</div>

<div id="content">
	{{  $content }}
</div>

{{  Asset::container('footer')->scripts(); }}
</body>
</html>