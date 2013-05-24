<!-- | TEMPLATE show page (main template) -->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="no-cache" />
    <title><?php $this->set('#title#'); ?> | TSunic <?php echo $TSunic->Config->get('version'); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php $this->set('#path_format#'); ?>" />
    <script type="text/javascript" src="javascript/$$$jQuery.js" charset="utf-8"></script>
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
    </div>
    <?php $this->display('$usersystem$userheader'); ?>
    <?php $this->display('$$$settings'); ?>
    <?php $this->display('$navigation__tsuniccoremodule$show'); ?>
    <?php $this->display('$$$includeJavascript'); ?>
</body>
</html>
