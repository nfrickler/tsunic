<!-- | Template: show content of mail -->
<?php

// get input
$Mail = $this->getVar('mail');

// return content of mail
$content = $Mail->getContent();

// print html-mail
if (strstr($content, "<html")) {
	echo $content;
	return;
}

// print plain-text
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="cache-control" content="no-cache" />
		<title><?php echo $Mail->getInfo('subject'); ?></title>
	</head>
	<body>
		<?php echo $content; ?>
	</body>
</html>
