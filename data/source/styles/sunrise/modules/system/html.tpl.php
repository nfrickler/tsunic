<!-- | TEMPLATE_sunrise - show page (main template) -->
<?php
$lang = $TSunic->Usr->config('$system$language');
if (empty($lang)) $lang = $TSunic->Config->get('default_language');
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="cache-control" content="no-cache" />
    <title><?php $this->set('#title#'); ?> | TSunic <?php echo $TSunic->Config->get('version'); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php $this->set('#path_format#'); ?>" />
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
    </div>
    <?php $this->display('$usersystem$userheader'); ?>
    <?php $this->display('$$$settings'); ?>
    <?php $this->display('$navigation__tsuniccoremodule$show'); ?>
    <?php $this->display('$$$includeJavascript'); ?>
</body>
</html>
