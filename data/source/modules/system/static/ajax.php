<!-- | handle ajax requests -->
<?php
// set XML-header
header("Content-type: text/xml");

// load ajax
include 'static/init.php';

// run TSunic
$TSunic->run();

// return XML-response
echo '<?xml version="1.0" encoding="utf-8" ?>';
$TSunic->display();
?>
