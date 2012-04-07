<!-- | load javascript of current page -->
<?php
// return Javascript-header
header('Content-Type: text/javascript; charset=utf-8');

// include TSunic.class
include_once 'runtime/classes/TSunic.class.php';

// start TSunic
$TSunic = new TSunic();

// return JS-code
$code = $TSunic->Tmpl->getAllJavascript();
foreach ($code as $index => $value) {
	echo base64_decode($value);
}
?>
