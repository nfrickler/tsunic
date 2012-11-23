<!-- | handle/download/load private images -->
<?php
// init TSunic
include __DIR__ . 'static/init.php';

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
