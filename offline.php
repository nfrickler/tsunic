<!-- | This page is shown, if TSunic is offline -->
<?php
// try to include config.php
$path = 'config.php';
$ts_configs = array();
if (file_exists($path)) include_once $path;
?>
<h1>Dear User,</h1>
<p>
	We are sorry, but this system is currently offline.<br />
	We hope you will return later to get access to our site being online again...
</p>
<p>
	<a href="index.php">Try again now!</a>
</p>

<?php if (isset($ts_configs['system_offline_since'])) { ?>
<p>
	This system is offline since:
	<?php echo $ts_configs['system_offline_since']; ?>
</p>
<?php } ?>
