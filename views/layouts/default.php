<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $meta_title ?> | Layla</title>
	<?php echo Asset::container('header')->styles(); ?>
	<?php echo Asset::container('header')->scripts(); ?>
</head>
<body>
<div id="main">
	<?php echo $content ?>
</div>
<?php echo Asset::container('footer')->scripts(); ?>
</body>
</html>