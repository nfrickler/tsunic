<!-- | Template: show content of mail -->
<?php
$Mail = $this->getVar('mail');

// print HTML mail
if ($Mail->getHtmlContent()) {
    echo $Mail->getHtmlContent();
    return;
}

// print plain mail
?>
<!DOCTYPE html>
<html>
    <head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="cache-control" content="no-cache" />
	<title><?php echo $Mail->getInfo('subject'); ?></title>
</head>
    <body>
	<?php echo nl2br($Mail->getPlainContent()); ?>
    </body>
</html>
