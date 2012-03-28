<!-- | function to autoenable javascript -->
<?php

function $$$autoenableJavascript () {
	global $TSunic;

	// enable javascript
	$TSunic->run('$$$enableJavascript', false, true);

	// activate xml-template
	$data = array('success' => 'true');
	$TSunic->Tmpl->activate('$$$autoenableJavascript', 'xmlResponse', $data);
	return true;
}
?>
