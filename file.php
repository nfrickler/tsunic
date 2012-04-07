<!-- | handle/download/load private images -->
<?php
// include TSunic.class
include_once 'runtime/classes/TSunic.class.php';

// start TSunic
$TSunic = new TSunic();

// get requested id
$id = (isset($_GET['id'])) ? $_GET['id'] : false;
if (empty($id) OR !is_numeric($id)) die('Access denied!');

// get Userfile-object
$Userfile = $TSunic->getUserfile($id);
if (!$Userfile->isValid()) die('Access denied!');

// is download?
$download = (isset($_GET['download']) AND $_GET['download'] == 'true') ? true : false;

// send download-headers
if ($download) {
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header('Content-Disposition: attachment; filename='.$Userfile->getInfo('name'));
	header("Content-Transfer-Encoding: binary");
}

// send mime-type in header
if ($Userfile->getMimeType()) header('Content-Type: '.$Userfile->getMimeType());

// include file
$Userfile->includeFile();
?>
