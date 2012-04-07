<!-- | handle ajax requests -->
<?php
// set XML-header
header("Content-type: text/xml");

// include TSunic.class
include_once 'runtime/classes/TSunic.class.php';

// start TSunic
$TSunic = new TSunic();

// run TSunic
$TSunic->run();

// return XML-response
echo '<?xml version="1.0" encoding="utf-8" ?>';
$TSunic->display();
?>
