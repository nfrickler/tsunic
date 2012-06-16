<!-- | handle/download/load private images -->
<?php
/* DEBUG ********************************/
error_reporting(E_ALL);
ini_set('display_errors', 1);
/* DEBUG END ****************************/

// include TSunic.class
include_once 'runtime/classes/TSunic.class.php';

// start TSunic
$TSunic = new TSunic();

// get requested id
$id = (isset($_GET['id'])) ? $_GET['id'] : false;
if (empty($id) OR !is_numeric($id)) die('Access denied!');

// get File-object
$File = $TSunic->getFsFile($id);
if (!$File->isValid()) die('Access denied!');

// is download?
$download = (isset($_GET['download']) AND $_GET['download'] == 'true')
    ? true : false;

// send download-headers
if ($download) {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header('Content-Disposition: attachment; filename='.$File->getInfo('name'));
    header("Content-Transfer-Encoding: binary");
}

// send mime-type in header
if ($File->getMimeType()) header('Content-Type: '.$File->getMimeType());

// include file
echo $File->getContent();
?>
