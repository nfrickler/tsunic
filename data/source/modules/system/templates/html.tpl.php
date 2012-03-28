<!-- | TEMPLATE - show page (main template) -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="cache-control" content="no-cache" />
	<title><?php $this->setVar('title'); ?> | TSunic 4.1</title>
	<link rel="stylesheet" type="text/css" href="<?php $this->setVar('path_format'); ?>" />
	<script type="text/javascript" src="runtime/javascript/$$$jQuery.js"></script>
</head>
<body>
	<div id="div_tsunic">
		<div id="$$$div__left">
			&nbsp;
		</div>
		<div id="$$$div__center">
			<?php $this->display('$$$header'); ?>
			<?php $this->display('$$$content'); ?>
			<?php $this->display('$$$navigation_header'); ?>
			<?php $this->display('$$$footer'); ?>
		</div>
		<?php $this->display('$navigation__tsuniccoremodule$show'); ?>
	</div>
	<?php $this->display('$$$settings'); ?>
	<?php $this->display('$$$includeJavascript'); ?>
</body>
</html>
