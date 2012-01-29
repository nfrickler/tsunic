<!-- | TEMPLATE_sunrise - show page (main template) -->
<?php
/** header ***********************************************************
 * project:			TSunic 4.1 | sunrise 1.0
 * file:			modules/system/html.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * **************************************************************** */

$lang = $TSunic->Config->getRuntime('lang');
if (empty($lang)) $lang = $TSunic->Config->getConfig('default_language');
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="cache-control" content="no-cache" />
	<title><?php $this->setVar('title'); ?> | TSunic <?php echo $TSunic->Config->getConfig('version'); ?></title>
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
