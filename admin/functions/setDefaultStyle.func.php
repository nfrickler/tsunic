<!-- | function to set default style -->
<?php
function setDefaultStyle () {

    // get id__style
    $id__style = (isset($_GET['id']) AND is_numeric($_GET['id'])) ? $_GET['id'] : 0;
    if (empty($id__style)) return true;

    // get style-object
    $Style = new ts_Style($id__style);

    // delete
    if (!$Style->setAsDefault()) {
	// error
	$_SESSION['admin_error'] = 'ERROR__SETDEFAULTSTYLE';
	return false;
    }

    $_SESSION['admin_info'] = 'INFO__SETDEFAULTSTYLE';
    return true;
}
?>
